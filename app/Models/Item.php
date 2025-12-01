<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Inventory;
use App\Models\SalesItem;


class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [ 
        'name',
        'sku',
        'price',
        'status'
    ];

    // Only one item can have only one inventory ie one-to-one r/ship
    public function inventory(): HasOne
    { 
        return $this->hasOne(Inventory::class);
    }

    // one item can have many sales items ie one-to-many
    public function saleItems(): HasMany
    { 
        return $this->hasMany(SalesItem::class);
    }

}
