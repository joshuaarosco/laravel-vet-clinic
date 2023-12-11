<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pets extends Model
{
    use SoftDeletes;

    protected $table = 'pets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'patient_id',
        'name',
        'birthday',
        'sex',
        'weight',
        'race',
        'species',
        'color',
        'path',
        'directory',
        'filename',
    ];

    public function getAvatar(){
        if($this->filename!='' AND $this->directory!=''){
            return $this->directory.'/'.$this->filename;
        }
        return 'vet-clinic/images/face0.jpg';
    }

    public function patient(){
        return $this->belongsTo('App\Models\Backoffice\Patient', 'patient_id','id');
    }
}
