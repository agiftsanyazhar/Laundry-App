<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the promo for the Shop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promo(): HasMany
    {
        return $this->hasMany(Promo::class, 'shop_id', 'id');
    }

    /**
     * Get all of the laundry for the Shop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laundry(): HasMany
    {
        return $this->hasMany(Laundry::class, 'shop_id', 'id');
    }
}
