<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name', 'description','price','category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
