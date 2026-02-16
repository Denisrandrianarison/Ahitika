<a href="{{ route('cart') }}" class="relative group" wire:navigate>
    <div class="flex items-center space-x-1 text-gray-700 hover:text-purple-600 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        <span class="hidden md:inline font-medium">Panier</span>
    </div>
    @if($itemCount > 0)
        <span class="absolute -top-2 -right-2 bg-gradient-to-r from-purple-600 to-pink-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
            {{ $itemCount > 99 ? '99+' : $itemCount }}
        </span>
    @endif
</a>
