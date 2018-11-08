<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{ 
	protected $fillable = ['image'];
	
    protected $table = 'home_page_gallery';
}
