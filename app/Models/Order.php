<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'numero',
        'client_nom',
        'client_tel',
        'adresse',
        'total',
        'statut',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->numero)) {
                $order->numero = 'CMD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatutLabelAttribute(): string
    {
        return match($this->statut) {
            'en_attente' => 'En attente',
            'en_preparation' => 'En préparation',
            'en_livraison' => 'En livraison',
            'livree' => 'Livrée',
            default => $this->statut,
        };
    }
}
