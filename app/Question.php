<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";

    protected $fillable = ['selling_car_id','question','seller_id','question_date'];

    public function car_for_sale(){
        return $this->belongsTo('App\SellingCar');
    }
}
