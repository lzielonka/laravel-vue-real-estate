<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'lists';
    protected $with = ['city', 'developer'];
    protected $fillable = ['price', 'name', 'isOnSale', 'city_id', 'developer_id'];
    protected $hidden = ['city_id', 'developer_id', 'created_at', 'updated_at'];

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function developer()
    {
        return $this->hasOne(Developer::class, 'id', 'developer_id');
    }
}
