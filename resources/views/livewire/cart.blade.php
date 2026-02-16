<div>
    @if(count($items) > 0)
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($items as $item)
                    <div class="bg-white rounded-xl shadow-sm p-4 flex items-center space-x-4" wire:key="cart-item-{{ $item['product']->id }}">
                        <!-- Product Image -->
                        <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if($item['product']->images && count($item['product']->images) > 0)
                                <img src="{{ Storage::url($item['product']->images[0]) }}"
                                     alt="{{ $item['product']->nom }}"
                                     class="w-full h-full object-cover">
                            @else
                                @php
                                    $productImages = [
                                        'robe-ete-fleurie' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=200&h=200&fit=crop',
                                        'jean-slim-bleu-femme' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=200&h=200&fit=crop',
                                        'blouse-elegante' => 'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=200&h=200&fit=crop',
                                        'veste-jean-vintage' => 'https://images.unsplash.com/photo-1551537482-f2075a1d41f2?w=200&h=200&fit=crop',
                                        'chemise-casual-blanche' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=200&h=200&fit=crop',
                                        'polo-ralph-lauren' => 'https://images.unsplash.com/photo-1586363104862-3a5e2ab60d99?w=200&h=200&fit=crop',
                                        'jean-levis-501' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=200&h=200&fit=crop',
                                        'sweat-capuche-nike' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=200&h=200&fit=crop',
                                        'nike-air-max-90' => 'https://images.unsplash.com/photo-1514989940723-e8e51635b782?w=200&h=200&fit=crop',
                                        'escarpins-noirs' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=200&h=200&fit=crop',
                                        'mocassins-cuir-homme' => 'https://images.unsplash.com/photo-1614252369475-531eba835eb1?w=200&h=200&fit=crop',
                                        'chanel-no-5' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=200&h=200&fit=crop',
                                        'dior-sauvage' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?w=200&h=200&fit=crop',
                                        'versace-bright-crystal' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=200&h=200&fit=crop',
                                        'hugo-boss-bottled' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?w=200&h=200&fit=crop',
                                        'montre-michael-kors' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=200&h=200&fit=crop',
                                        'ceinture-gucci' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200&h=200&fit=crop',
                                        'lunettes-ray-ban' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=200&h=200&fit=crop',
                                        'foulard-soie' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=200&h=200&fit=crop',
                                        'sac-louis-vuitton' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=200&h=200&fit=crop',
                                        'sac-bandouliere-coach' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=200&h=200&fit=crop',
                                        'sac-dos-fjallraven' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200&h=200&fit=crop',
                                    ];
                                    $imgUrl = $productImages[$item['product']->slug] ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=200&h=200&fit=crop';
                                @endphp
                                <img src="{{ $imgUrl }}"
                                     alt="{{ $item['product']->nom }}"
                                     class="w-full h-full object-cover">
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('product.show', $item['product']->slug) }}"
                               class="text-gray-900 font-semibold hover:text-purple-600 transition truncate block">
                                {{ $item['product']->nom }}
                            </a>
                            <p class="text-sm text-gray-500 mt-1">{{ $item['product']->category->nom ?? '' }}</p>
                            <div class="mt-2">
                                <span class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                                    {{ number_format($item['product']->prix, 0, ',', ' ') }} Ar
                                </span>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="flex items-center">
                            <button wire:click="decrementQuantity({{ $item['product']->id }})"
                                    class="w-9 h-9 rounded-l-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-purple-100 hover:text-purple-600 transition border border-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <span class="w-12 h-9 flex items-center justify-center font-bold text-gray-900 bg-white border-t border-b border-gray-200">{{ $item['quantity'] }}</span>
                            <button wire:click="incrementQuantity({{ $item['product']->id }})"
                                    class="w-9 h-9 rounded-r-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-purple-100 hover:text-purple-600 transition border border-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                    {{ $item['quantity'] >= $item['product']->stock ? 'disabled' : '' }}>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Subtotal -->
                        <div class="text-right min-w-[100px]">
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Sous-total</p>
                            <p class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                                {{ number_format($item['product']->prix * $item['quantity'], 0, ',', ' ') }} Ar
                            </p>
                        </div>

                        <!-- Remove Button -->
                        <div x-data="{ confirmDelete: false }" class="ml-2 flex-shrink-0">
                            <template x-if="!confirmDelete">
                                <button @click="confirmDelete = true"
                                        class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center text-red-500 hover:bg-red-100 hover:text-red-600 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </template>
                            <template x-if="confirmDelete">
                                <div class="flex items-center space-x-1">
                                    <button wire:click="removeItem({{ $item['product']->id }})"
                                            class="px-3 py-1.5 bg-red-500 text-white text-xs font-medium rounded-lg hover:bg-red-600 transition">
                                        Oui
                                    </button>
                                    <button @click="confirmDelete = false"
                                            class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded-lg hover:bg-gray-200 transition">
                                        Non
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                @endforeach

                <!-- Clear Cart Button -->
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('shop') }}" class="text-purple-600 hover:text-purple-800 font-medium flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Continuer les achats</span>
                    </a>
                    <div x-data="{ confirmClear: false }" class="relative">
                        <template x-if="!confirmClear">
                            <button @click="confirmClear = true"
                                    class="text-red-500 hover:text-red-700 font-medium flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                <span>Vider le panier</span>
                            </button>
                        </template>
                        <template x-if="confirmClear">
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600 text-sm">Vider le panier ?</span>
                                <button wire:click="clearCart"
                                        class="px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition">
                                    Oui
                                </button>
                                <button @click="confirmClear = false"
                                        class="px-3 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                                    Non
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Resume de la commande</h2>

                    <div class="space-y-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Sous-total ({{ count($items) }} {{ count($items) > 1 ? 'articles' : 'article' }})</span>
                            <span>{{ number_format($total, 0, ',', ' ') }} Ar</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Livraison</span>
                            <span class="text-green-600 font-medium">Gratuite</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                                    {{ number_format($total, 0, ',', ' ') }} Ar
                                </span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}"
                       class="mt-6 w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold py-4 px-8 rounded-full hover:opacity-90 transition transform hover:scale-[1.02] shadow-lg flex items-center justify-center space-x-2">
                        <span>Passer la commande</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Payment Info -->
                    <div class="mt-6 p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-green-800 font-medium">Paiement a la livraison</p>
                                <p class="text-green-600 text-sm">Payez en especes a la reception</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
            <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Votre panier est vide</h2>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">
                Decouvrez notre selection de produits et ajoutez vos articles preferes au panier.
            </p>
            <a href="{{ route('shop') }}"
               class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-full hover:opacity-90 transition transform hover:scale-105 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Voir nos produits
            </a>
        </div>
    @endif
</div>
