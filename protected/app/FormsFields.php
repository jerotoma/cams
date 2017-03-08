<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormsFields extends Model
{
    //
    protected $casts = [
        'values' => 'array',
    ];
}
