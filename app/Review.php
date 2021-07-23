<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable =['description', 'mail', 'vote'];
    public function users(){
        return $this->belongsTo('App\User');
    }
}
