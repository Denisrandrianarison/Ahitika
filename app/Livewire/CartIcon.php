<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public int $itemCount = 0;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('cart-updated')]
    public function updateCount()
    {
        $this->itemCount = app(CartService::class)->getItemCount();
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
