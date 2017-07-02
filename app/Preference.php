<?php

namespace AdopteUnIench;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    public $timestamps = false;

    protected $fillable = ['sex', 'location', 'profile_id'];
}
