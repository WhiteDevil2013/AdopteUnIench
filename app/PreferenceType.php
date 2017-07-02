<?php

namespace AdopteUnIench;

use Illuminate\Database\Eloquent\Model;

class PreferenceType extends Model
{
    public $timestamps = false;

    protected $fillable = ['race', 'preference_id'];
}
