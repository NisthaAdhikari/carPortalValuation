<?php

namespace App\Http\Controllers\ApiController;

use App\Car;
use App\Classes\slim;
use App\Http\Controllers\Controller;
use App\SellingCar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\CarImage;
use App\Seller;
use Redirect;
use App\Question;
use Image;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class ClientController extends Controller
{
    public function getAllCars(){
        $cars = SellingCar::with('car','image','seller')->get();
        return $cars;
    }

    public function getCarDetails($id){
        $car = SellingCar::find($id);
        $details = SellingCar::find($id)->car;
        $seller = SellingCar::find($id)->seller;
        $images = SellingCar::find($id)->image;

        $questions= DB::table('questions')
                ->join('sellers','questions.seller_id', '=', 'sellers.id')
                ->where('questions.selling_car_id',$id)->get();

        return [$car,$details,$seller,$images,$questions];
    }

    public function getNewCars(){
        $cars = SellingCar::where('car_status','unused')->with('car','image','seller')->get();
        return $cars;
    }

    public function getOldCars(){
        $cars = SellingCar::where('car_status','used')->with('car','image','seller')->get();
        return $cars;
    }

    public function saveCarForSale(Request $request){


        $selling_car =new SellingCar();
        $selling_car->car_id= $request->car_id;
        $selling_car->make_year= $request->make_year;
        $selling_car->kms_run= $request->kms_run;
        $selling_car->engine_cc= $request->engine_cc;
        if(is_null($request->color)){
            $selling_car->color= "#000000";
        }
        else{
            $selling_car->color= $request->color;
        }
        $selling_car->car_status= $request->car_status;
        $selling_car->asking_price= $request->asking_price;
        $selling_car->seller_id= $request->seller_id;
        $selling_car->additional_details= $request->additional_details;
        $selling_car->post_date= $request->upload_date;

        $selling_car->additional_details= $request->additional_details;

        $mySave = $selling_car->save();

        if($mySave){
            if($request->image){
                $extension = explode('/', mime_content_type($request->image))[1];
                $name = time().'.'.$extension;
                // $name=time().'.'.explode('/', explode(':', substr($request->image,0, strpos($request->image, ';'))))[1][1];
                $height = Image::make($request->image)->save(public_path('upload/'.$name));
            }

            $carImage = new CarImage();
            $carImage->selling_car_id = $selling_car->id;
            $carImage->image = "upload/".$name;

            $saveImage = $carImage->save();
            if($saveImage){
                return "Car for sale saved";
            }
        }
        else {
            return ['message'=>'Car for sale adding failed!'];
        }
    }

      public function saveSeller(Request $request){
        $validator = Validator::make($request->all(), [
             'name' => 'required',
            'contact' => 'required',
            'email' => 'required|email|unique:sellers',
            'location' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
          return response()->json(['errors'=>$validator->errors()]);

        }
        else{
          $seller=new Seller();
          $seller->name = $request->name;
          $seller->email= $request->email;
          $seller->number = $request->contact;
          $seller->location= $request->location;
          $seller->password = Hash::make($request->password);

          $saved= $seller->save();

          if ($saved) {
            return $seller;
          }
          else{
            return "Seller could not be registered";
          }
        }
      }

      public function sellerLogin(Request $request){
        $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required',
       ]);

       if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
       }
      else{
        $email = $request->email;
        $data = $request->all();
        $users = Seller::where('email', $data['email'])->first();
        if ($users) {
            if (Hash::check($data['password'], $users->password)) {
                return $users;
            } else {
                return ['message'=>'Password is incorrect'];
            }
        } else {
            return ['message'=>'User does not exist'];
        }
      }
    }

    public function postQuestions(Request $request){

        $question= new Question();
        $question->selling_car_id= $request->selling_car_id;
        $question->seller_id= $request->seller_id;
        $question->question= $request->question;
        $question->question_date= $request->question_date;
        $saved= $question->save();
        if ($saved) {
            return ['message'=>'Question posted!!'];
        }
    }

    public function getUserProfile($id){
        $userDetails = Seller::where('id', $id)->first();
        $profileDetails = SellingCar::where('seller_id',$id)->with('car','image')->get();

         $questionsAsked= DB::table('questions')
                    ->join('selling_cars','questions.selling_car_id', '=', 'selling_cars.id')
                    ->join('sellers','selling_cars.seller_id', '=', 'sellers.id')
                    ->where('selling_cars.seller_id',$id)->get();

        return [$userDetails, $profileDetails, $questionsAsked];
    }

    public function getAllBrands(){
        $brands = Car::latest()->pluck('brand');
        return $brands;
    }

    public function getModel($brand){
        $models= Car::where('brand',$brand)->pluck('model');
        return $models;
    }

    public function getVersion($brand,$model){
        $version= Car::where('brand',$brand)->where('model',$model)->get();
        return $version;
    }

    public function delete($id) {
        $car = SellingCar::findOrFail($id);
        if($car){
            $car->delete();
            return "Deleted!!";
        }
        else{
            return response()->json(error);
        }

        return response()->json(null);
        }
}
