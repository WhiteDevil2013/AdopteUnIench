<?php

namespace AdopteUnIench;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'username', 'isAnimal', 'race',  'description', 'birthDate', 'location', 'profilePicture', 'sex'
    ];

}
