<x-layouts.shop>
    <x-slot:title>Commande confirmee</x-slot:title>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <!-- Success Icon -->
            <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">Commande confirmee!</h1>
            <p class="text-xl text-gray-600 mb-8">
                Merci pour votre commande. Nous vous contacterons bientot.
            </p>

            <!-- Order Number -->
            <div class="inline-block bg-purple-50 rounded-xl px-6 py-4 mb-8">
                <p class="text-sm text-purple-600 font-medium mb-1">Numero de commande</p>
                <p class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                    {{ $order->numero }}
                </p>
            </div>

            <!-- Order Details -->
            <div class="bg-gray-50 rounded-xl p-6 text-left mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Details de la commande</h2>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nom</span>
                        <span class="font-medium text-gray-900">{{ $order->client_nom }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Telephone</span>
                        <span class="font-medium text-gray-900">{{ $order->client_tel }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Adresse</span>
                        <span class="font-medium text-gray-900 text-right max-w-xs">{{ $order->adresse }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3 flex justify-between">
                        <span class="text-gray-600">Total a payer</span>
                        <span class="text-xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                            {{ number_format($order->total, 0, ',', ' ') }} Ar
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-gray-50 rounded-xl p-6 text-left mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Articles commandes</h2>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden">
                                    @if($item->product && $item->product->images && count($item->product->images) > 0)
                                        <img src="{{ Storage::url($item->product->images[0]) }}"
                                             alt="{{ $item->product->nom }}"
                                             class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $item->product->nom ?? 'Produit' }}</p>
                                    <p class="text-sm text-gray-500">x{{ $item->quantite }}</p>
                                </div>
                            </div>
                            <p class="font-medium text-gray-900">
                                {{ number_format($item->prix_unitaire * $item->quantite, 0, ',', ' ') }} Ar
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-blue-50 rounded-xl p-6 text-left mb-8">
                <h2 class="text-lg font-semibold text-blue-900 mb-3">Prochaines etapes</h2>
                <ul class="space-y-2 text-blue-700">
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Notre equipe va preparer votre commande</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Vous recevrez un appel pour confirmer la livraison</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Payez en especes a la livraison</span>
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('shop') }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-full hover:opacity-90 transition shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Continuer mes achats
                </a>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-8 py-4 border-2 border-purple-600 text-purple-600 font-semibold rounded-full hover:bg-purple-50 transition">
                    Retour a l'accueil
                </a>
            </div>
        </div>
    </div>
</x-layouts.shop>
