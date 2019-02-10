<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'developer_id', 'id');
    }
}
