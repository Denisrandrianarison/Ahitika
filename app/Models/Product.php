<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'nom',
        'slug',
        'description',
        'prix',
        'stock',
        'images',
        'actif',
        'is_nouveau',
    ];

    protected $casts = [
        'images' => 'array',
        'actif' => 'boolean',
        'is_nouveau' => 'boolean',
        'prix' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->nom);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    public function scopeDisponible($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function getFirstImageAttribute(): ?string
    {
        return $this->images[0] ?? null;
    }
}
