<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'availed_service_id',
        'item_id',
        'quantity',
        'price',
    ];

    public function item(){
        return $this->belongsTo('App\Models\Backoffice\Inventory', 'item_id','id');
    }
}
