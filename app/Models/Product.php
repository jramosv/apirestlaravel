<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  

  

    protected $fillable = [
        'id',
        'name',
        'price',
        'category_id',
        'img'

    ];

    public function categories() {
        return $this->hasMany(Category::class);
    }
}
