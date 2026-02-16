<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class ProductCard extends Component
{
    public Product $product;
    public bool $added = false;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        app(CartService::class)->addToCart($this->product->id);
        $this->added = true;
        $this->dispatch('cart-updated');

        // Reset animation after 2 seconds
        $this->dispatch('reset-added')->self();
    }

    public function resetAdded()
    {
        $this->added = false;
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
