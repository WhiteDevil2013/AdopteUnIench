<?php

namespace AdopteUnIench;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public $timestamps = false;

    protected $fillable = ['profile_id_1', 'profile_id_2'];
}
