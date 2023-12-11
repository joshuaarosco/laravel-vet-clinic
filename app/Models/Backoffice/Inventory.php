<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    protected $table = 'inventory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'item_code',
        'name',
        'type',
        'stock',
        'purchase_price',
        'sale_price',
        'profit',
        'total_profit',
        'expiration_date',
    ];
}
