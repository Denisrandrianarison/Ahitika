<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    public string $client_nom = '';
    public string $client_tel = '';
    public string $adresse = '';
    public string $notes = '';
    public array $items = [];
    public float $total = 0;

    protected $rules = [
        'client_nom' => 'required|min:3|max:255',
        'client_tel' => 'required|regex:/^[0-9]{10}$/',
        'adresse' => 'required|min:10|max:500',
    ];

    protected $messages = [
        'client_nom.required' => 'Veuillez entrer votre nom complet.',
        'client_nom.min' => 'Le nom doit contenir au moins 3 caracteres.',
        'client_tel.required' => 'Veuillez entrer votre numero de telephone.',
        'client_tel.regex' => 'Le numero doit contenir 10 chiffres (ex: 0341234567).',
        'adresse.required' => 'Veuillez entrer votre adresse de livraison.',
        'adresse.min' => 'L\'adresse doit contenir au moins 10 caracteres.',
    ];

    public function mount()
    {
        $cartService = app(CartService::class);
        $this->items = $cartService->getCartItems();
        $this->total = $cartService->getTotal();

        if (empty($this->items)) {
            return redirect()->route('cart');
        }
    }

    public function placeOrder()
    {
        $this->validate();

        $cartService = app(CartService::class);
        $this->items = $cartService->getCartItems();
        $this->total = $cartService->getTotal();

        if (empty($this->items)) {
            session()->flash('error', 'Votre panier est vide.');
            return redirect()->route('cart');
        }

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'client_nom' => $this->client_nom,
                'client_tel' => $this->client_tel,
                'adresse' => $this->adresse,
                'total' => $this->total,
                'statut' => 'en_attente',
            ]);

            // Create order items and update stock
            foreach ($this->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantite' => $item['quantity'],
                    'prix_unitaire' => $item['product']->prix,
                ]);

                // Decrease stock
                $item['product']->decrement('stock', $item['quantity']);
            }

            DB::commit();

            // Clear cart
            $cartService->clearCart();
            $this->dispatch('cart-updated');

            // Redirect to success page
            return redirect()->route('order.success', $order->numero);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Une erreur est survenue. Veuillez reessayer.');
        }
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
