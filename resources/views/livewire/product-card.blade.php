<div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
    <!-- Image -->
    <a href="{{ route('product.show', $product->slug) }}" class="block relative overflow-hidden">
        <div class="aspect-square bg-gray-100">
            @if($product->first_image)
                <img src="{{ Storage::url($product->first_image) }}"
                     alt="{{ $product->nom }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                @php
                    $productImages = [
                        // Vêtements Femme
                        'robe-ete-fleurie' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=400&h=500&fit=crop',
                        'jean-slim-bleu-femme' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&h=500&fit=crop',
                        'blouse-elegante' => 'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=400&h=500&fit=crop',
                        'veste-jean-vintage' => 'https://images.unsplash.com/photo-1551537482-f2075a1d41f2?w=400&h=500&fit=crop',
                        // Vêtements Homme
                        'chemise-casual-blanche' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=500&fit=crop',
                        'polo-ralph-lauren' => 'https://images.unsplash.com/photo-1586363104862-3a5e2ab60d99?w=400&h=500&fit=crop',
                        'jean-levis-501' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400&h=500&fit=crop',
                        'sweat-capuche-nike' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=400&h=500&fit=crop',
                        // Chaussures
                        'nike-air-max-90' => 'https://images.unsplash.com/photo-1514989940723-e8e51635b782?w=400&h=500&fit=crop',
                        'escarpins-noirs' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=400&h=500&fit=crop',
                        'mocassins-cuir-homme' => 'https://images.unsplash.com/photo-1614252369475-531eba835eb1?w=400&h=500&fit=crop',
                        // Parfums
                        'chanel-no-5' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=400&h=500&fit=crop',
                        'dior-sauvage' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?w=400&h=500&fit=crop',
                        'versace-bright-crystal' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=400&h=500&fit=crop',
                        'hugo-boss-bottled' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?w=400&h=500&fit=crop',
                        // Accessoires
                        'montre-michael-kors' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=400&h=500&fit=crop',
                        'ceinture-gucci' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=500&fit=crop',
                        'lunettes-ray-ban' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400&h=500&fit=crop',
                        'foulard-soie' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=400&h=500&fit=crop',
                        // Sacs
                        'sac-louis-vuitton' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=400&h=500&fit=crop',
                        'sac-bandouliere-coach' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&h=500&fit=crop',
                        'sac-dos-fjallraven' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=500&fit=crop',
                    ];
                    $imgUrl = $productImages[$product->slug] ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=400&h=500&fit=crop';
                @endphp
                <img src="{{ $imgUrl }}"
                     alt="{{ $product->nom }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @endif
        </div>

        <!-- Badges -->
        <div class="absolute top-3 left-3 flex flex-col gap-2">
            @if($product->stock <= 0)
                <span class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Rupture</span>
            @elseif($product->stock <= 5)
                <span class="bg-orange-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Stock limité</span>
            @endif
            @if($product->is_nouveau || $product->created_at->diffInDays(now()) <= 7)
                <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Nouveau</span>
            @endif
        </div>
    </a>

    <!-- Content -->
    <div class="p-4">
        <!-- Category -->
        <a href="{{ route('shop', ['category' => $product->category->slug]) }}"
           class="text-xs text-purple-600 font-medium uppercase tracking-wide hover:text-purple-800">
            {{ $product->category->nom }}
        </a>

        <!-- Name -->
        <a href="{{ route('product.show', $product->slug) }}">
            <h3 class="mt-1 text-gray-900 font-semibold text-lg line-clamp-2 hover:text-purple-600 transition">
                {{ $product->nom }}
            </h3>
        </a>

        <!-- Price & Cart -->
        <div class="mt-3 flex items-center justify-between">
            <div>
                <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                    {{ number_format($product->prix, 0, ',', ' ') }}
                </span>
                <span class="text-sm text-gray-500">Ar</span>
            </div>

            @if($product->stock > 0)
                <button wire:click="addToCart"
                        wire:loading.attr="disabled"
                        class="relative bg-gradient-to-r from-purple-600 to-pink-500 text-white p-3 rounded-full hover:opacity-90 transition transform hover:scale-105 active:scale-95 disabled:opacity-50">
                    <span wire:loading.remove wire:target="addToCart">
                        @if($added)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        @endif
                    </span>
                    <span wire:loading wire:target="addToCart">
                        <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </span>
                </button>
            @else
                <span class="text-sm text-red-500 font-medium">Indisponible</span>
            @endif
        </div>
    </div>
</div>
