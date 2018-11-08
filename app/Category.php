<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category', 'category_slug'];

    public function products()
    {
    	return $this->hasMany('App\Product');
    }
}