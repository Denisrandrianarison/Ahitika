<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['nom' => 'Vêtements Femme', 'slug' => 'vetements-femme'],
            ['nom' => 'Vêtements Homme', 'slug' => 'vetements-homme'],
            ['nom' => 'Chaussures', 'slug' => 'chaussures'],
            ['nom' => 'Parfums', 'slug' => 'parfums'],
            ['nom' => 'Accessoires', 'slug' => 'accessoires'],
            ['nom' => 'Sacs', 'slug' => 'sacs'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Get categories
        $vetementsFemme = Category::where('slug', 'vetements-femme')->first();
        $vetementsHomme = Category::where('slug', 'vetements-homme')->first();
        $chaussures = Category::where('slug', 'chaussures')->first();
        $parfums = Category::where('slug', 'parfums')->first();
        $accessoires = Category::where('slug', 'accessoires')->first();
        $sacs = Category::where('slug', 'sacs')->first();

        // Products
        $products = [
            // Vêtements Femme
            [
                'category_id' => $vetementsFemme->id,
                'nom' => 'Robe d\'été fleurie',
                'slug' => 'robe-ete-fleurie',
                'description' => 'Magnifique robe d\'été avec motifs floraux. Tissu léger et confortable, parfaite pour les journées ensoleillées. Taille M.',
                'prix' => 45000,
                'stock' => 5,
                'actif' => true,
            ],
            [
                'category_id' => $vetementsFemme->id,
                'nom' => 'Jean slim bleu',
                'slug' => 'jean-slim-bleu-femme',
                'description' => 'Jean slim de qualité, coupe moderne et flatteuse. Denim stretch confortable. Taille 38.',
                'prix' => 55000,
                'stock' => 8,
                'actif' => true,
            ],
            [
                'category_id' => $vetementsFemme->id,
                'nom' => 'Blouse élégante',
                'slug' => 'blouse-elegante',
                'description' => 'Blouse élégante pour occasion spéciale ou bureau. Tissu soyeux, coupe féminine. Taille S/M.',
                'prix' => 35000,
                'stock' => 6,
                'actif' => true,
            ],
            [
                'category_id' => $vetementsFemme->id,
                'nom' => 'Veste en jean vintage',
                'slug' => 'veste-jean-vintage',
                'description' => 'Veste en jean vintage, style décontracté. Parfait état, lavage authentique. Taille M.',
                'prix' => 65000,
                'stock' => 3,
                'actif' => true,
            ],
            // Vêtements Homme
            [
                'category_id' => $vetementsHomme->id,
                'nom' => 'Chemise casual blanche',
                'slug' => 'chemise-casual-blanche',
                'description' => 'Chemise casual en coton blanc, coupe regular. Idéale pour le bureau ou les sorties. Taille L.',
                'prix' => 40000,
                'stock' => 10,
                'actif' => true,
            ],
            [
                'category_id' => $vetementsHomme->id,
                'nom' => 'Polo Ralph Lauren',
                'slug' => 'polo-ralph-lauren',
                'description' => 'Polo de marque en excellent état. Coton premium, logo brodé. Couleur navy. Taille M.',
                'prix' => 75000,
                'stock' => 4,
                'actif' => true,
            ],
            [
                'category_id' => $vetementsHomme->id,
                'nom' => 'Jean Levi\'s 501',
                'slug' => 'jean-levis-501',
                'description' => 'Jean Levi\'s 501 original, coupe droite classique. Denim de qualité supérieure. Taille 32.',
                'prix' => 85000,
                'stock' => 5,
                'actif' => true,
            ],
            [
                'category_id' => $vetementsHomme->id,
                'nom' => 'Sweat à capuche Nike',
                'slug' => 'sweat-capuche-nike',
                'description' => 'Sweat à capuche Nike, style sportswear. Très confortable, parfait état. Taille L.',
                'prix' => 60000,
                'stock' => 7,
                'actif' => true,
            ],
            // Chaussures
            [
                'category_id' => $chaussures->id,
                'nom' => 'Nike Air Max 90',
                'slug' => 'nike-air-max-90',
                'description' => 'Baskets Nike Air Max 90 en excellent état. Confort optimal, style iconique. Pointure 42.',
                'prix' => 120000,
                'stock' => 3,
                'actif' => true,
            ],
            [
                'category_id' => $chaussures->id,
                'nom' => 'Escarpins noirs',
                'slug' => 'escarpins-noirs',
                'description' => 'Escarpins noirs élégants, talon 7cm. Parfaits pour les occasions spéciales. Pointure 38.',
                'prix' => 55000,
                'stock' => 4,
                'actif' => true,
            ],
            [
                'category_id' => $chaussures->id,
                'nom' => 'Mocassins cuir homme',
                'slug' => 'mocassins-cuir-homme',
                'description' => 'Mocassins en cuir véritable, style classique. Confortables et élégants. Pointure 43.',
                'prix' => 75000,
                'stock' => 5,
                'actif' => true,
            ],
            // Parfums
            [
                'category_id' => $parfums->id,
                'nom' => 'Chanel N°5',
                'slug' => 'chanel-no-5',
                'description' => 'Parfum féminin iconique Chanel N°5. Eau de parfum 50ml, flacon presque plein.',
                'prix' => 180000,
                'stock' => 2,
                'actif' => true,
            ],
            [
                'category_id' => $parfums->id,
                'nom' => 'Dior Sauvage',
                'slug' => 'dior-sauvage',
                'description' => 'Eau de toilette Dior Sauvage pour homme. 100ml, utilisé à 20%. Senteur fraîche et masculine.',
                'prix' => 150000,
                'stock' => 3,
                'actif' => true,
            ],
            [
                'category_id' => $parfums->id,
                'nom' => 'Versace Bright Crystal',
                'slug' => 'versace-bright-crystal',
                'description' => 'Parfum féminin Versace Bright Crystal. 90ml, comme neuf. Notes florales et fruitées.',
                'prix' => 95000,
                'stock' => 4,
                'actif' => true,
            ],
            [
                'category_id' => $parfums->id,
                'nom' => 'Hugo Boss Bottled',
                'slug' => 'hugo-boss-bottled',
                'description' => 'Eau de toilette Hugo Boss Bottled. 100ml, très bon état. Parfum élégant et masculin.',
                'prix' => 85000,
                'stock' => 6,
                'actif' => true,
            ],
            // Accessoires
            [
                'category_id' => $accessoires->id,
                'nom' => 'Montre Michael Kors',
                'slug' => 'montre-michael-kors',
                'description' => 'Montre femme Michael Kors en acier doré. Cadran nacré, bracelet à maillons. Excellent état.',
                'prix' => 145000,
                'stock' => 2,
                'actif' => true,
            ],
            [
                'category_id' => $accessoires->id,
                'nom' => 'Ceinture Gucci',
                'slug' => 'ceinture-gucci',
                'description' => 'Ceinture Gucci en cuir noir avec boucle GG. Taille 85cm. Authentique.',
                'prix' => 125000,
                'stock' => 3,
                'actif' => true,
            ],
            [
                'category_id' => $accessoires->id,
                'nom' => 'Lunettes Ray-Ban',
                'slug' => 'lunettes-ray-ban',
                'description' => 'Lunettes de soleil Ray-Ban Aviator classiques. Verres polarisés, étui inclus.',
                'prix' => 95000,
                'stock' => 5,
                'actif' => true,
            ],
            [
                'category_id' => $accessoires->id,
                'nom' => 'Foulard en soie',
                'slug' => 'foulard-soie',
                'description' => 'Foulard en soie imprimé, motifs géométriques. 90x90cm. Élégant et polyvalent.',
                'prix' => 35000,
                'stock' => 8,
                'actif' => true,
            ],
            // Sacs
            [
                'category_id' => $sacs->id,
                'nom' => 'Sac à main Louis Vuitton',
                'slug' => 'sac-louis-vuitton',
                'description' => 'Sac à main Louis Vuitton Neverfull MM. Toile monogram, très bon état. Pochette incluse.',
                'prix' => 450000,
                'stock' => 1,
                'actif' => true,
            ],
            [
                'category_id' => $sacs->id,
                'nom' => 'Sac bandoulière Coach',
                'slug' => 'sac-bandouliere-coach',
                'description' => 'Sac bandoulière Coach en cuir camel. Compact et pratique, parfait pour tous les jours.',
                'prix' => 85000,
                'stock' => 4,
                'actif' => true,
            ],
            [
                'category_id' => $sacs->id,
                'nom' => 'Sac à dos Fjallraven',
                'slug' => 'sac-dos-fjallraven',
                'description' => 'Sac à dos Fjallraven Kanken classique. Couleur moutarde, excellent état.',
                'prix' => 65000,
                'stock' => 6,
                'actif' => true,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
