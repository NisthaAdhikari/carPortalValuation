<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = "sellers";

    protected $fillable = ['name',	'location',	'email', 'password','number'];

    public function sellingcars(){
    	return $this->hasMany('App\SellingCar');
    }
}
