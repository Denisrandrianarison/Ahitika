<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class AddToCartButton extends Component
{
    public Product $product;
    public int $quantity = 1;
    public int $maxQuantity;
    public bool $showSuccess = false;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->maxQuantity = $product->stock;
    }

    public function increment()
    {
        if ($this->quantity < $this->maxQuantity) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $cartService = app(CartService::class);
        $cartService->addToCart($this->product->id, $this->quantity);

        $this->dispatch('cart-updated');
        $this->showSuccess = true;

        // Reset après 3 secondes
        $this->dispatch('hide-success')->self();
    }

    public function hideSuccess()
    {
        $this->showSuccess = false;
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
