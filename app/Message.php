<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender', 'employee_id', 'message', 'conversation_id'];

    public function conversation()
    {
        return $this->belongsTo('App\Conversation');
    }
}
