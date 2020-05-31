<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingCar extends Model
{
	protected $table = "selling_cars";

    protected $fillable = ['car_id','make_year','kms_run',	'engine_cc','color',	'asking_price',	'seller_id','seller_name',	'phone',	'additional_details',	'post_date','car_status'];

    public function car(){
        return $this->belongsTo('App\Car');
    }

    public function seller(){
        return $this->belongsTo('App\Seller');
    }

    public function image(){
    	return $this->hasOne('App\CarImage');
    }

    public function carImages(){
    	return $this->hasMany('App\CarImage');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }
}
