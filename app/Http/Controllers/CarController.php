<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\slim;
use Illuminate\Support\Facades\DB;
use App\Car;
use Session;
use App\CarImage;
use Redirect;
use Image;
use File;

class CarController extends Controller
{
	public function index(){
    	$cars =Car::latest()->get();
    	return view('admin.cars.index', compact('cars'));
    }

    public function showForm(){


      return view("admin.cars.form");
    }


     public function store(Request $request){
      $request->validate([
        'brand' => 'required',
        'model' => 'required|max:100',
        'version' => 'required',
        'current_mp' => 'required',
        'features' => 'required',
      ]);
      $car =new Car();
      $car->brand= $request->brand;
      $car->model= $request->model;
      $car->version= $request->version;
      $car->current_mp= $request->current_mp;
      $car->features= $request->features;
      $mySave = $car->save();


      if ($mySave) {
          Session::flash('flash_message', 'Car data successfully saved');
        return redirect()->route('car.index');
      }


      else {
        Session::flash('flash_message', 'Car could not be added!');

        return redirect()->route('car.index');
      }
    }



    public function edit(Request $request,$id){


      $cars = Car::findOrFail($id);


      return view('admin.cars.editForm', compact('cars'));
    }

    public function update(Request $request , $id){
    	$request->validate([
        'brand' => 'required',
        'model' => 'required|max:100',
        'current_mp' => 'required',
        'features' => 'required',
      	]);

      try{
        $update = Car::findOrFail($id);

        $update->brand= $request->brand;
        $update->model= $request->model;
        $update->version= $request->version;

        $update->current_mp= $request->current_mp;
        $update->features= $request->features;
        $myUpdate = $update->update();

        $car = $update->id;

      if ($myUpdate) {

            Session::flash('flash_message', 'Car details successfully updated!');

            return redirect()->route('car.index');
          }
          else {
            Session::flash('flash_message', 'Car details could not be updated!');

            return redirect()->route('car.index');
          }


      }
      catch(Exception $e){
        Session::flash('flash_message', 'Car details could not be updated!');

            return redirect()->route('car.index');
      }
    }


     public function delete($id){
      $deleted = Car::find($id);
      $done = $deleted->delete();

      if ($done) {
        Session::flash('flash_message', 'Car details successfully deleted!');

        return redirect()->route('car.index');
      }
      else {
        Session::flash('flash_message', 'Car details could not be deleted!');

        return redirect()->route('car.index');
      }

    }

}
