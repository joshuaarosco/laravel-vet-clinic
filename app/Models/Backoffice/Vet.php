<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vet extends Model
{
    use SoftDeletes;

    protected $table = 'veterinarians';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'fname',
        'lname',
        'salutation',
        'address',
        'specialty',
        'bio',
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

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }

}
