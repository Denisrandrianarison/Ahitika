<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ImageSearchService
{
    /**
     * Slug-to-URL mapping for products without local images.
     */
    private const FALLBACK_IMAGES = [
        'robe-ete-fleurie' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=400&h=500&fit=crop',
        'jean-slim-bleu-femme' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&h=500&fit=crop',
        'blouse-elegante' => 'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=400&h=500&fit=crop',
        'veste-jean-vintage' => 'https://images.unsplash.com/photo-1551537482-f2075a1d41f2?w=400&h=500&fit=crop',
        'chemise-casual-blanche' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=500&fit=crop',
        'polo-ralph-lauren' => 'https://images.unsplash.com/photo-1586363104862-3a5e2ab60d99?w=400&h=500&fit=crop',
        'jean-levis-501' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400&h=500&fit=crop',
        'sweat-capuche-nike' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=400&h=500&fit=crop',
        'nike-air-max-90' => 'https://images.unsplash.com/photo-1514989940723-e8e51635b782?w=400&h=500&fit=crop',
        'escarpins-noirs' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=400&h=500&fit=crop',
        'mocassins-cuir-homme' => 'https://images.unsplash.com/photo-1614252369475-531eba835eb1?w=400&h=500&fit=crop',
        'chanel-no-5' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=400&h=500&fit=crop',
        'dior-sauvage' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?w=400&h=500&fit=crop',
        'versace-bright-crystal' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=400&h=500&fit=crop',
        'hugo-boss-bottled' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?w=400&h=500&fit=crop',
        'montre-michael-kors' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=400&h=500&fit=crop',
        'ceinture-gucci' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=500&fit=crop',
        'lunettes-ray-ban' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400&h=500&fit=crop',
        'foulard-soie' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=400&h=500&fit=crop',
        'sac-louis-vuitton' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=400&h=500&fit=crop',
        'sac-bandouliere-coach' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&h=500&fit=crop',
        'sac-dos-fjallraven' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=500&fit=crop',
    ];

    /**
     * Search products by image similarity using color histogram comparison.
     */
    private const MIN_SIMILARITY = 0.85;

    public function searchByImage(UploadedFile $image, int $limit = 12): array
    {
        $uploadedHistogram = $this->extractColorHistogram($image->getRealPath());

        if (empty($uploadedHistogram)) {
            return [];
        }

        $products = Product::with('category')->actif()->get();
        $results = [];

        foreach ($products as $product) {
            $productHistogram = $this->getProductHistogram($product);
            if (empty($productHistogram)) {
                continue;
            }

            $similarity = $this->compareHistograms($uploadedHistogram, $productHistogram);

            // Only keep products above the similarity threshold
            if ($similarity >= self::MIN_SIMILARITY) {
                $results[] = [
                    'product' => $product,
                    'similarity' => $similarity,
                ];
            }
        }

        // Sort by similarity (highest first)
        usort($results, fn($a, $b) => $b['similarity'] <=> $a['similarity']);

        return array_slice($results, 0, $limit);
    }

    /**
     * Get the histogram for a product, using cache to avoid reprocessing.
     */
    private function getProductHistogram(Product $product): array
    {
        $cacheKey = 'img_hist_' . $product->id . '_' . $product->updated_at->timestamp;

        return Cache::remember($cacheKey, 3600, function () use ($product) {
            // Try local image first
            if ($product->first_image) {
                $imagePath = Storage::disk('public')->path($product->first_image);
                if (file_exists($imagePath)) {
                    return $this->extractColorHistogram($imagePath);
                }
            }

            // Fallback to Unsplash URL
            $url = self::FALLBACK_IMAGES[$product->slug] ?? null;
            if (!$url) {
                return [];
            }

            return $this->extractColorHistogramFromUrl($url);
        });
    }

    /**
     * Extract histogram from a remote URL.
     */
    private function extractColorHistogramFromUrl(string $url): array
    {
        $ctx = stream_context_create([
            'http' => ['timeout' => 10],
            'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
        ]);

        $data = @file_get_contents($url, false, $ctx);
        if (!$data) {
            return [];
        }

        $image = @imagecreatefromstring($data);
        if (!$image) {
            return [];
        }

        return $this->buildHistogram($image);
    }

    /**
     * Extract a color histogram from a local image file.
     */
    private function extractColorHistogram(string $path): array
    {
        $image = $this->createImageFromFile($path);
        if (!$image) {
            return [];
        }

        return $this->buildHistogram($image);
    }

    /**
     * Build histogram from a GD image resource.
     */
    private function buildHistogram(\GdImage $image): array
    {
        // Resize to 32x32 for faster processing
        $thumb = imagecreatetruecolor(32, 32);
        imagecopyresampled($thumb, $image, 0, 0, 0, 0, 32, 32, imagesx($image), imagesy($image));
        imagedestroy($image);

        $bins = 8;
        $binSize = 256 / $bins;
        $histogram = array_fill(0, $bins * 3, 0);
        $totalPixels = 32 * 32;

        for ($x = 0; $x < 32; $x++) {
            for ($y = 0; $y < 32; $y++) {
                $rgb = imagecolorat($thumb, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $histogram[(int)($r / $binSize)]++;
                $histogram[$bins + (int)($g / $binSize)]++;
                $histogram[$bins * 2 + (int)($b / $binSize)]++;
            }
        }

        imagedestroy($thumb);

        // Normalize
        for ($i = 0; $i < count($histogram); $i++) {
            $histogram[$i] /= $totalPixels;
        }

        return $histogram;
    }

    /**
     * Compare two histograms using cosine similarity.
     */
    private function compareHistograms(array $hist1, array $hist2): float
    {
        $dotProduct = 0;
        $magnitude1 = 0;
        $magnitude2 = 0;

        for ($i = 0; $i < count($hist1); $i++) {
            $dotProduct += $hist1[$i] * $hist2[$i];
            $magnitude1 += $hist1[$i] ** 2;
            $magnitude2 += $hist2[$i] ** 2;
        }

        $magnitude1 = sqrt($magnitude1);
        $magnitude2 = sqrt($magnitude2);

        if ($magnitude1 == 0 || $magnitude2 == 0) {
            return 0;
        }

        return $dotProduct / ($magnitude1 * $magnitude2);
    }

    /**
     * Create a GD image resource from a local file path.
     */
    private function createImageFromFile(string $path): ?\GdImage
    {
        $info = @getimagesize($path);
        if (!$info) {
            return null;
        }

        return match ($info[2]) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($path),
            IMAGETYPE_PNG => @imagecreatefrompng($path),
            IMAGETYPE_GIF => @imagecreatefromgif($path),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null,
            default => null,
        };
    }
}
