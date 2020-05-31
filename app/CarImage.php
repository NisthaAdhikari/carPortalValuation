<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    protected $table = 'car_images';
    protected $fillable = ['selling_car_id','image'];

    public function selling_car(){
        return $this->belongsTo('App\SellingCar');
    }

}
