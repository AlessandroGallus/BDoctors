<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname', 'address', 'city', 'date_of_birth','CF','phone_number','url_img','url_cv','visit_types'
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

    public function specializations(){
        return $this->belongsToMany('App\Specialization');
    }
    
    public function sponsors(){
        return $this->belongsToMany('App\Sponsor','user_sponsor')->withPivot('expiring_date');
    }

    public function messages(){
        return $this->hasMany('App\Message')->orderBy('created_at');
    }

    public function reviews(){
        return $this->hasMany('App\Review')->orderBy('created_at');
    }
}
