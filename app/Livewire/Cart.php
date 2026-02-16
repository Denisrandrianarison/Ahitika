<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;

class Cart extends Component
{
    public array $items = [];
    public float $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $cartService = app(CartService::class);
        $this->items = $cartService->getCartItems();
        $this->total = $cartService->getTotal();
    }

    public function updateQuantity($productId, $quantity)
    {
        app(CartService::class)->updateQuantity($productId, (int)$quantity);
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function incrementQuantity($productId)
    {
        $cartService = app(CartService::class);
        $cart = $cartService->getCart();

        if (isset($cart[$productId])) {
            $product = \App\Models\Product::find($productId);
            $currentQty = $cart[$productId]['quantity'];

            if ($product && $currentQty < $product->stock) {
                $cartService->updateQuantity($productId, $currentQty + 1);
                $this->loadCart();
                $this->dispatch('cart-updated');
            }
        }
    }

    public function decrementQuantity($productId)
    {
        $cartService = app(CartService::class);
        $cart = $cartService->getCart();

        if (isset($cart[$productId])) {
            $currentQty = $cart[$productId]['quantity'];

            if ($currentQty > 1) {
                $cartService->updateQuantity($productId, $currentQty - 1);
                $this->loadCart();
                $this->dispatch('cart-updated');
            }
        }
    }

    public function removeItem($productId)
    {
        app(CartService::class)->removeFromCart($productId);
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function clearCart()
    {
        app(CartService::class)->clearCart();
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
