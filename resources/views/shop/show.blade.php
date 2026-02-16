<x-layouts.shop>
    <x-slot:title>{{ $product->nom }}</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-purple-600">Accueil</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="{{ route('shop') }}" class="text-gray-500 hover:text-purple-600">Boutique</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="text-gray-900 font-medium truncate max-w-xs">{{ $product->nom }}</span>
                </li>
            </ol>
        </nav>

        <!-- Product Detail -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8 p-8">
                <!-- Images -->
                <div>
                    @php
                        $productImages = [
                            'robe-ete-fleurie' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=600&h=600&fit=crop',
                            'jean-slim-bleu-femme' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=600&h=600&fit=crop',
                            'blouse-elegante' => 'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=600&h=600&fit=crop',
                            'veste-jean-vintage' => 'https://images.unsplash.com/photo-1551537482-f2075a1d41f2?w=600&h=600&fit=crop',
                            'chemise-casual-blanche' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=600&h=600&fit=crop',
                            'polo-ralph-lauren' => 'https://images.unsplash.com/photo-1586363104862-3a5e2ab60d99?w=600&h=600&fit=crop',
                            'jean-levis-501' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=600&h=600&fit=crop',
                            'sweat-capuche-nike' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=600&h=600&fit=crop',
                            'nike-air-max-90' => 'https://images.unsplash.com/photo-1514989940723-e8e51635b782?w=600&h=600&fit=crop',
                            'escarpins-noirs' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=600&h=600&fit=crop',
                            'mocassins-cuir-homme' => 'https://images.unsplash.com/photo-1614252369475-531eba835eb1?w=600&h=600&fit=crop',
                            'chanel-no-5' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=600&h=600&fit=crop',
                            'dior-sauvage' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?w=600&h=600&fit=crop',
                            'versace-bright-crystal' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=600&h=600&fit=crop',
                            'hugo-boss-bottled' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?w=600&h=600&fit=crop',
                            'montre-michael-kors' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=600&h=600&fit=crop',
                            'ceinture-gucci' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&h=600&fit=crop',
                            'lunettes-ray-ban' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=600&h=600&fit=crop',
                            'foulard-soie' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=600&h=600&fit=crop',
                            'sac-louis-vuitton' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=600&h=600&fit=crop',
                            'sac-bandouliere-coach' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&h=600&fit=crop',
                            'sac-dos-fjallraven' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&h=600&fit=crop',
                        ];
                        $fallbackImage = $productImages[$product->slug] ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=600&fit=crop';
                        $hasUploadedImages = $product->images && count($product->images) > 0;
                    @endphp

                    <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden mb-4">
                        @if($hasUploadedImages)
                            <img id="mainImage" src="{{ Storage::url($product->images[0]) }}"
                                 alt="{{ $product->nom }}"
                                 class="w-full h-full object-cover">
                        @else
                            <img id="mainImage" src="{{ $fallbackImage }}"
                                 alt="{{ $product->nom }}"
                                 class="w-full h-full object-cover">
                        @endif
                    </div>

                    @if($hasUploadedImages && count($product->images) > 1)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($product->images as $index => $image)
                                <button onclick="document.getElementById('mainImage').src='{{ Storage::url($image) }}'"
                                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-purple-500 focus:border-purple-500 transition">
                                    <img src="{{ Storage::url($image) }}" alt="" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div>
                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}"
                       class="inline-block text-sm text-purple-600 font-medium uppercase tracking-wide hover:text-purple-800 mb-2">
                        {{ $product->category->nom }}
                    </a>

                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->nom }}</h1>

                    <!-- Price -->
                    <div class="mb-6">
                        <span class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                            {{ number_format($product->prix, 0, ',', ' ') }}
                        </span>
                        <span class="text-xl text-gray-500">Ar</span>
                    </div>

                    <!-- Stock Status -->
                    <div class="mb-6">
                        @if($product->stock > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                En stock ({{ $product->stock }} disponibles)
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                Rupture de stock
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($product->description)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                            <div class="prose prose-sm text-gray-600">
                                {!! $product->description !!}
                            </div>
                        </div>
                    @endif

                    <!-- Add to Cart -->
                    @if($product->stock > 0)
                        @livewire('add-to-cart-button', ['product' => $product])
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 font-semibold py-4 px-8 rounded-full cursor-not-allowed">
                            Produit indisponible
                        </button>
                    @endif

                    <!-- Features -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Livraison rapide</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Paiement a la livraison</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Produits similaires</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        @livewire('product-card', ['product' => $related], key($related->id))
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.shop>
