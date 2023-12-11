<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'invoice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'record_id',
        'patient_id',
        'invoice_number',
        'amount',
        'status',
        'description',
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Patient', 'patient_id','id');
    }

    public function record(){
        return $this->belongsTo('App\Models\Record', 'record_id','id');
    }

}
