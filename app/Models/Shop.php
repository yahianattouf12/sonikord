<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable=[];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSearchShopByName($query,$name)
    {
        return $query->where('name','like','%' . $name .'%');
    }
}
