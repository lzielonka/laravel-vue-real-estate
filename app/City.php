<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'country'];
    protected $hidden = ['created_at', 'updated_at'];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'city_id', 'id');
    }
}
