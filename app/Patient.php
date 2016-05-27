<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'gender', 'year_of_birth',
    ];

}
