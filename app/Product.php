<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['products_categories_id','price','title','image','description','sale','qty','options'];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
