<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const CART_KEY = 'cart';

    public function getCart(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    public function addToCart(int $productId, int $quantity = 1): void
    {
        $cart = $this->getCart();
        $product = Product::find($productId);

        if (!$product) {
            return;
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
            ];
        }

        Session::put(self::CART_KEY, $cart);
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
            Session::put(self::CART_KEY, $cart);
        }
    }

    public function removeFromCart(int $productId): void
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        Session::put(self::CART_KEY, $cart);
    }

    public function clearCart(): void
    {
        Session::forget(self::CART_KEY);
    }

    public function getItemCount(): int
    {
        $cart = $this->getCart();
        return array_sum(array_column($cart, 'quantity'));
    }

    public function getTotal(): float
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->prix * $item['quantity'];
            }
        }

        return $total;
    }

    public function getCartItems(): array
    {
        $cart = $this->getCart();
        $items = [];

        foreach ($cart as $productId => $cartItem) {
            $product = Product::with('category')->find($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $cartItem['quantity'],
                ];
            }
        }

        return $items;
    }
}
