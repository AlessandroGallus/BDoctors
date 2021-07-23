<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =['message_text', 'mail', 'phone_number'];
    public function users(){
        return $this->belongsTo('App\User');
    }
}
