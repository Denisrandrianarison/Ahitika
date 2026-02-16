<x-layouts.shop>
    <x-slot:title>Boutique</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-purple-600">Accueil</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="text-gray-900 font-medium">Boutique</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filtres</h3>

                    <form action="{{ route('shop') }}" method="GET">
                        <!-- Categories -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-3">Categories</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="category" value=""
                                           {{ !request('category') ? 'checked' : '' }}
                                           class="w-4 h-4 text-purple-600 border-gray-300 focus:ring-purple-500">
                                    <span class="ml-2 text-gray-700">Toutes</span>
                                </label>
                                @foreach($categories as $category)
                                    <label class="flex items-center">
                                        <input type="radio" name="category" value="{{ $category->slug }}"
                                               {{ request('category') == $category->slug ? 'checked' : '' }}
                                               class="w-4 h-4 text-purple-600 border-gray-300 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">{{ $category->nom }}</span>
                                        <span class="ml-auto text-sm text-gray-400">({{ $category->products_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-3">Prix (Ariary)</h4>
                            <div class="flex items-center gap-2">
                                <input type="number" name="min_price" placeholder="Min"
                                       value="{{ request('min_price') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-purple-500 focus:border-purple-500">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="max_price" placeholder="Max"
                                       value="{{ request('max_price') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-purple-500 focus:border-purple-500">
                            </div>
                        </div>

                        <!-- Sort -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-3">Trier par</h4>
                            <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-purple-500 focus:border-purple-500">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus recents</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix decroissant</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nom A-Z</option>
                            </select>
                        </div>

                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white font-medium py-2 px-4 rounded-lg hover:opacity-90 transition">
                            Appliquer les filtres
                        </button>

                        @if(request()->hasAny(['category', 'min_price', 'max_price', 'sort', 'search']))
                            <a href="{{ route('shop') }}" class="block text-center mt-3 text-sm text-gray-500 hover:text-purple-600">
                                Reinitialiser
                            </a>
                        @endif
                    </form>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="flex-1">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-600">
                        @if(!empty($imageSearch))
                            <span class="font-medium text-gray-900">{{ $products->total() }}</span> produits similaires trouves
                            <span class="inline-flex items-center gap-1 ml-2 px-2 py-1 bg-purple-100 text-purple-700 text-xs font-medium rounded-full">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Recherche par image
                            </span>
                        @else
                            <span class="font-medium text-gray-900">{{ $products->total() }}</span> produits trouves
                            @if(request('search'))
                                pour "<span class="text-purple-600">{{ request('search') }}</span>"
                            @endif
                        @endif
                    </p>
                </div>

                <!-- Products -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            @livewire('product-card', ['product' => $product], key($product->id))
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-16 bg-white rounded-2xl">
                        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun produit trouve</h3>
                        <p class="text-gray-500 mb-4">Essayez de modifier vos filtres</p>
                        <a href="{{ route('shop') }}" class="text-purple-600 hover:text-purple-800 font-medium">
                            Voir tous les produits
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.shop>
