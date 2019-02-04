<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'lists';

    protected $fillable = ['price', 'name', 'isOnSale'];
}
