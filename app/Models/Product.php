<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $attributes = [
        'avatar_url' => '/resources/img/default-avatar.png'
    ];
}
