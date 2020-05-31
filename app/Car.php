<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = "cars";

    protected $fillable = ['model','brand','version','current_mp', 'features'];

    protected $searchable = [
        'model',
        'brand',
        'version'
    ];

    public function selling_cars(){
        return $this->hasMany('App\SellingCar');
    }

}
