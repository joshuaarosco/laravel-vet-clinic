<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function patient(){
        return $this->hasOne('App\Models\Backoffice\Patient', 'user_id','id');
    }

    public function vet(){
        return $this->hasOne('App\Models\Backoffice\Vet', 'user_id','id');
    }

    public function getAvatar(){
        if(auth()->user()->type == 'patient')
            return $this->patient->getAvatar();
        if(auth()->user()->type == 'vet')
            return $this->vet->getAvatar();
        return 'vet-clinic/images/face0.jpg';
    }
}
