<?php

namespace AdopteUnIench;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;

    protected $fillable = ['sender_id', 'receiver_id', 'message'];

}
