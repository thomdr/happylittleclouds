<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['visitor_ip', 'has_new_messages'];

    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
