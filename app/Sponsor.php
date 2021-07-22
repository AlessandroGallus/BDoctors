<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model    
{
    protected $fillable = ['sponsor_level', ' price', 'name', 'duration'];
    public function users(){
        return $this->belongsToMany('App\User','user_sponsor');
    }
}
