<x-layouts.shop>
    <x-slot:title>Accueil</x-slot:title>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-purple-900 via-purple-800 to-pink-700 overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-1000"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Découvrez la <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-pink-400">Mode Tendance</span>
                </h1>
                <p class="text-xl md:text-2xl text-purple-100 mb-8 max-w-2xl mx-auto">
                    Friperie de qualité, parfums et accessoires au meilleur prix à Madagascar
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center justify-center px-8 py-4 bg-white text-purple-700 font-semibold rounded-full hover:bg-gray-100 transition transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Voir la boutique
                    </a>
                    <a href="#categories"
                       class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white/10 transition">
                        Nos catégories
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </section>

    <!-- Features -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="flex items-center space-x-4 p-6 bg-white rounded-xl shadow-sm">
                    <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Livraison Rapide</h3>
                        <p class="text-sm text-gray-500">Partout à Madagascar</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-6 bg-white rounded-xl shadow-sm">
                    <div class="flex-shrink-0 w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Qualité Garantie</h3>
                        <p class="text-sm text-gray-500">Produits sélectionnés</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-6 bg-white rounded-xl shadow-sm">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Paiement à la Livraison</h3>
                        <p class="text-sm text-gray-500">Cash uniquement</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-6 bg-white rounded-xl shadow-sm">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Support Client</h3>
                        <p class="text-sm text-gray-500">7j/7 par téléphone</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section id="categories" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos Catégories</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Explorez notre sélection de produits soigneusement choisis pour vous</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($categories as $category)
                    <a href="{{ route('shop', ['category' => $category->slug]) }}"
                       class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="aspect-square bg-gradient-to-br from-purple-100 to-pink-100">
                            @if($category->image)
                                <img src="{{ Storage::url($category->image) }}"
                                     alt="{{ $category->nom }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                @php
                                    $catImages = [
                                        'vetements-femme' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=400&h=400&fit=crop',
                                        'vetements-homme' => 'https://images.unsplash.com/photo-1617137968427-85924c800a22?w=400&h=400&fit=crop',
                                        'chaussures' => 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=400&h=400&fit=crop',
                                        'parfums' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=400&h=400&fit=crop',
                                        'accessoires' => 'https://images.unsplash.com/photo-1611923134239-b9be5816e23c?w=400&h=400&fit=crop',
                                        'sacs' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&h=400&fit=crop',
                                    ];
                                    $catImg = $catImages[$category->slug] ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=400&h=400&fit=crop';
                                @endphp
                                <img src="{{ $catImg }}"
                                     alt="{{ $category->nom }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-white font-semibold text-lg">{{ $category->nom }}</h3>
                            <p class="text-white/80 text-sm">{{ $category->products_count }} produits</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Aucune catégorie disponible</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Nouveautés</h2>
                    <p class="text-gray-600">Découvrez nos derniers articles</p>
                </div>
                <a href="{{ route('shop') }}"
                   class="hidden md:inline-flex items-center text-purple-600 hover:text-purple-800 font-medium transition">
                    Voir tout
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    @livewire('product-card', ['product' => $product], key($product->id))
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 mb-4">Aucun produit disponible pour le moment</p>
                        <p class="text-sm text-gray-400">Revenez bientôt pour découvrir nos nouveautés!</p>
                    </div>
                @endforelse
            </div>

            <div class="md:hidden text-center mt-8">
                <a href="{{ route('shop') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-medium rounded-full hover:opacity-90 transition">
                    Voir tous les produits
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-purple-600 to-pink-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Prêt à faire du shopping?</h2>
            <p class="text-purple-100 text-lg mb-8 max-w-2xl mx-auto">
                Découvrez des articles uniques à prix imbattables. Livraison disponible partout à Madagascar!
            </p>
            <a href="{{ route('shop') }}"
               class="inline-flex items-center justify-center px-8 py-4 bg-white text-purple-700 font-semibold rounded-full hover:bg-gray-100 transition transform hover:scale-105 shadow-lg">
                Commencer mes achats
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </section>
</x-layouts.shop>
