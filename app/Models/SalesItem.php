<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SalesItem extends Model
{
    /** @use HasFactory<\Database\Factories\SalesItemFactory> */
    use HasFactory;

    protected $fillable = [
        'item_id',
        'sales_id',
        'quantity',
        'price',
    ];

    public function sale(): BelongsTo{
        return $this->belongsTo(Sales::class);
    }

    public function item(): BelongsTo{
        return $this->belongsTo(Item::class);
    }
}
