<div x-data="{ showSuccess: @entangle('showSuccess') }"
     x-init="$watch('showSuccess', value => { if(value) setTimeout(() => $wire.hideSuccess(), 3000) })">

    <!-- Quantity Selector -->
    <div class="flex items-center space-x-4 mb-6">
        <span class="text-gray-700 font-medium">Quantite:</span>
        <div class="flex items-center border border-gray-300 rounded-full overflow-hidden">
            <button wire:click="decrement"
                    class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition"
                    @if($quantity <= 1) disabled @endif>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                </svg>
            </button>
            <span class="w-12 text-center font-semibold text-gray-900">{{ $quantity }}</span>
            <button wire:click="increment"
                    class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition"
                    @if($quantity >= $maxQuantity) disabled @endif>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Add to Cart Button -->
    <button wire:click="addToCart"
            wire:loading.attr="disabled"
            wire:loading.class="opacity-75 cursor-wait"
            class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold py-4 px-8 rounded-full hover:opacity-90 transition transform hover:scale-[1.02] shadow-lg flex items-center justify-center space-x-2">
        <span wire:loading.remove wire:target="addToCart">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </span>
        <span wire:loading wire:target="addToCart">
            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
        <span wire:loading.remove wire:target="addToCart">Ajouter au panier</span>
        <span wire:loading wire:target="addToCart">Ajout en cours...</span>
    </button>

    <!-- Success Message -->
    <div x-show="showSuccess"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="mt-4 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center space-x-3">
        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div class="flex-1">
            <p class="text-green-800 font-medium">Produit ajoute au panier!</p>
        </div>
        <a href="{{ route('cart') }}" class="text-green-600 hover:text-green-800 font-medium text-sm">
            Voir le panier
        </a>
    </div>
</div>
