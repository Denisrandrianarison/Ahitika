<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\ImageSearchService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        $categories = Category::withCount('products')->get();
        $featuredProducts = Product::with('category')
            ->actif()
            ->disponible()
            ->latest()
            ->take(8)
            ->get();

        return view('shop.home', compact('categories', 'featuredProducts'));
    }

    public function index(Request $request)
    {
        $query = Product::with('category')->actif();

        // Filter by category
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Price filter
        if ($request->filled('min_price')) {
            $query->where('prix', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('prix', '<=', $request->max_price);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('prix', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('prix', 'desc');
                break;
            case 'name':
                $query->orderBy('nom', 'asc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();

        return view('shop.index', compact('products', 'categories'));
    }

    public function searchByImage(Request $request, ImageSearchService $imageSearchService)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $results = $imageSearchService->searchByImage($request->file('image'));

        $productIds = collect($results)->pluck('product.id')->toArray();

        // Retrieve products in similarity order
        $products = Product::with('category')
            ->whereIn('id', $productIds)
            ->actif()
            ->get()
            ->sortBy(function ($product) use ($productIds) {
                return array_search($product->id, $productIds);
            });

        $categories = Category::withCount('products')->get();

        return view('shop.index', [
            'products' => new \Illuminate\Pagination\LengthAwarePaginator(
                $products->values(),
                $products->count(),
                12,
                1
            ),
            'categories' => $categories,
            'imageSearch' => true,
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->actif()
            ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->actif()
            ->disponible()
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }

    public function cart()
    {
        return view('shop.cart');
    }

    public function checkout()
    {
        return view('shop.checkout');
    }

    public function orderSuccess(string $numero)
    {
        $order = Order::with('items.product')
            ->where('numero', $numero)
            ->firstOrFail();

        return view('shop.order-success', compact('order'));
    }
}
