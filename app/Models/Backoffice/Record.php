<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use SoftDeletes;

    protected $table = 'health_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'vet_id',
        'patient_id',
        'pet_id',
        'service_id',
        'procedure',
        'weight',
        'notes',
    ];
    
    public function vet(){
        return $this->belongsTo('App\Models\Backoffice\Vet', 'vet_id','id');
    }
    
    public function patient(){
        return $this->belongsTo('App\Models\Backoffice\Patient', 'patient_id','id');
    }
    
    public function service(){
        return $this->belongsTo('App\Models\Backoffice\Service', 'service_id','id');
    }
    
    public function pet(){
        return $this->belongsTo('App\Models\Backoffice\Pets', 'pet_id','id');
    }

    public function invoice(){
        return $this->hasOne('App\Models\Backoffice\Invoice', 'record_id','id')->where('status','pending');
    }
}
