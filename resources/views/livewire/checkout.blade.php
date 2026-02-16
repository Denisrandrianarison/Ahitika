<div>
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center space-x-3">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-red-700">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form wire:submit="placeOrder" class="space-y-6">
                <!-- Personal Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center space-x-2">
                        <span class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-sm font-bold">1</span>
                        <span>Informations personnelles</span>
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="client_nom" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="client_nom"
                                   wire:model.live="client_nom"
                                   placeholder="Ex: Jean Rakoto"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition @error('client_nom') border-red-500 @enderror">
                            @error('client_nom')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="client_tel" class="block text-sm font-medium text-gray-700 mb-2">
                                Telephone <span class="text-red-500">*</span>
                            </label>
                            <input type="tel"
                                   id="client_tel"
                                   wire:model.live="client_tel"
                                   placeholder="Ex: 0341234567"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition @error('client_tel') border-red-500 @enderror">
                            @error('client_tel')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center space-x-2">
                        <span class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-sm font-bold">2</span>
                        <span>Adresse de livraison</span>
                    </h2>

                    <div>
                        <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse complete <span class="text-red-500">*</span>
                        </label>
                        <textarea id="adresse"
                                  wire:model.live="adresse"
                                  rows="3"
                                  placeholder="Ex: Lot IVG 123, Analakely, Antananarivo 101"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition @error('adresse') border-red-500 @enderror"></textarea>
                        @error('adresse')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-yellow-800 font-medium">Zone de livraison</p>
                                <p class="text-yellow-700 text-sm">Livraison disponible uniquement a Antananarivo et environs.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center space-x-2">
                        <span class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-sm font-bold">3</span>
                        <span>Mode de paiement</span>
                    </h2>

                    <div class="p-4 bg-green-50 border-2 border-green-200 rounded-xl">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-green-800 font-semibold">Paiement a la livraison (COD)</p>
                                <p class="text-green-600 text-sm">Payez en especes directement au livreur</p>
                            </div>
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button (Mobile) -->
                <div class="lg:hidden">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75 cursor-wait"
                            class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold py-4 px-8 rounded-full hover:opacity-90 transition shadow-lg flex items-center justify-center space-x-2">
                        <span wire:loading.remove wire:target="placeOrder">Confirmer la commande</span>
                        <span wire:loading wire:target="placeOrder">Traitement en cours...</span>
                        <svg wire:loading.remove wire:target="placeOrder" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <svg wire:loading wire:target="placeOrder" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Votre commande</h2>

                <!-- Items -->
                <div class="space-y-4 max-h-64 overflow-y-auto mb-6">
                    @foreach($items as $item)
                        <div class="flex items-center space-x-3" wire:key="checkout-item-{{ $item['product']->id }}">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
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
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $item['product']->nom }}</p>
                                <p class="text-sm text-gray-500">x{{ $item['quantity'] }}</p>
                            </div>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ number_format($item['product']->prix * $item['quantity'], 0, ',', ' ') }} Ar
                            </p>
                        </div>
                    @endforeach
                </div>

                <!-- Totals -->
                <div class="border-t border-gray-200 pt-4 space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Sous-total</span>
                        <span>{{ number_format($total, 0, ',', ' ') }} Ar</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Livraison</span>
                        <span class="text-green-600 font-medium">Gratuite</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex justify-between">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                                {{ number_format($total, 0, ',', ' ') }} Ar
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button (Desktop) -->
                <div class="hidden lg:block mt-6">
                    <button type="submit"
                            form="checkout-form"
                            wire:click="placeOrder"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75 cursor-wait"
                            class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold py-4 px-8 rounded-full hover:opacity-90 transition shadow-lg flex items-center justify-center space-x-2">
                        <span wire:loading.remove wire:target="placeOrder">Confirmer la commande</span>
                        <span wire:loading wire:target="placeOrder">Traitement en cours...</span>
                        <svg wire:loading.remove wire:target="placeOrder" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <svg wire:loading wire:target="placeOrder" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Back to Cart -->
                <a href="{{ route('cart') }}" class="mt-4 block text-center text-purple-600 hover:text-purple-800 font-medium">
                    Modifier le panier
                </a>
            </div>
        </div>
    </div>
</div>
