<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
