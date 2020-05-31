<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\slim;
use Illuminate\Support\Facades\DB;
use App\Car;
use App\SellingCar;
use App\Seller;
use Session;
use App\CarImage;
use Redirect;
use Image;
use File;
use Carbon\Carbon;

class SellingCarsController extends Controller
{
    public function index(){
        $cars = SellingCar::with('car','image','seller')->get();
    	return view('admin.sellingcars.index',compact('cars'));
    }

    public function showForm(){
    $brand = Car::latest()->distinct('brand')->get(['brand']);
    $years = array_reverse(range(1900, strftime("%Y", time())));
    $seller = Seller::all();
      return view("admin.sellingcars.form",compact('brand','years','seller'));
    }

    public function edit(Request $request,$id){


        $cars = SellingCar::findOrFail($id);
        $brand = Car::latest()->distinct('brand')->get(['brand']);

        $proImage = CarImage::where('selling_car_id',$id)->get();
        $years = array_reverse(range(1900, strftime("%Y", time())));
        $seller = Seller::all();

        return view('admin.sellingcars.editForm', compact('cars','proImage','brand','years','seller'));
      }

    public function fetch(Request $request){

    	$select = $request->get('select');
	     $value = $request->get('value');
	     $dependent = $request->get('dependent');

	     $data = DB::table('cars')
	       ->where($select, $value)
	       ->groupBy($dependent)
	       ->get();
	     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
	     foreach($data as $row)
	     {
	      $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
	     }
	     echo $output;
	}

	public function saveImage(Request $request){
      $random=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 4);

      foreach(request()->file as $f)
        $imageName = $f->getClientOriginalName();


        $filesize = $f->getSize();
        // dd($filesize);
        $height = Image::make($f)->height();
        $width = Image::make($f)->width();
        $reqHeight = (500/$width) * $height;


        if($filesize >= 1024)
        {
          $filesize = number_format($filesize / 1024, 2);
        }

        $image_path = "upload/".$imageName;
        $newName = $random."_".$imageName;
         if(File::exists($image_path)){


            if(($width > 500) || ((int)$filesize > 50)){
              $image_resize = Image::make($f->getRealPath());
              $image_resize->resize(500, $reqHeight);
              $image_resize->save(public_path('upload/' .$newName));
            }

            else{
               $f->move(public_path('upload'), $newName);
            }

            $carImage = new CarImage();
            $carImage->selling_car_id = $request->pId;
            $carImage->image = "upload/".$newName;

            $saveImage = $carImage->save();

            return response()->json(['uploaded' => '/upload/'.$newName]);
         }

         else{
          if(($width > 500) || ((int)$filesize > 50)){
            $image_resize = Image::make($f->getRealPath());
            $image_resize->resize(500, $reqHeight);
            $image_resize->save(public_path('upload/' .$imageName));
          }
          else{
            $f->move(public_path('upload'), $imageName);
          }
          $carImage = new CarImage();
            $carImage->selling_car_id = $request->pId;
            $carImage->image = "upload/".$newName;

            $saveImage = $carImage->save();

          return response()->json(['uploaded' => '/upload/'.$imageName]);
         }
    }

    public function store(Request $request){

      if ($request->version == "") {
      	$car_id=DB::table('cars')->where('brand','=',$request->brand)
      								->where('model','=',$request->model)->get();
      }
      else{
      	$car_id=DB::table('cars')->where('brand','=',$request->brand)->where('model','=',$request->model)
      								->where('version','=',$request->version)->get();
      }



      $selling_car =new SellingCar();
      $selling_car->car_id= $car_id[0]->id;

      $selling_car->make_year= $request->make_year;
      $selling_car->kms_run= $request->kms_run;
      $selling_car->engine_cc= $request->engine_cc;
      $selling_car->color= $request->color;
      $selling_car->car_status= $request->car_status;
      $selling_car->asking_price= $request->asking_price;
      $selling_car->seller_id= $request->seller_id;

      $selling_car->additional_details= $request->additional_details;
      $selling_car->post_date= Carbon::now();
      $mySave = $selling_car->save();

      $pId = $selling_car->id;

      if ($mySave) {
        $this->saveImageToProduct($selling_car->id);
          Session::flash('flash_message', 'Car for sale successfully saved');
        return redirect()->route('sellingcar.index');
      }


      else {
        Session::flash('flash_message', 'Car for sale could not be added!');

        return redirect()->route('sellingcar.index');
      }
    }

    public function saveImageToProduct($car){
      $images = Slim::getImages();

      foreach ($images as $image) {

        $files = array();
        // save output data if set
          if (isset($image['output']['data'])) {

              // Save the file
              $name = $image['output']['name'];

              // We'll use the output crop data
              $data = $image['output']['data'];

              $height = $image['output']['height'];
              $width = $image['output']['width'];
              $filesize = $image['input']['size'];

               //dd($image);

              // If you want to store the file in another directory pass the directory name as the third parameter.
              // dd($file);
              $imageName = $this->sanitizeFileName($name);
              $imageName = uniqid() . '_' . $imageName;

              $reqHeight = (800/$width) * $height;

              if($filesize >= 1024)
              {
                  $filesize = number_format($filesize / 1024, 2);
              }

              if(($width > 800) || ((int)$filesize > 50)){
                $file = Slim::saveFile($data, $name, public_path('upload/'));

                  //$image_resize = Image::make($data->getRealPath());
                  $image_resize = Image::make(public_path('upload/').$file);

                  // dd($image_resize);

                  $image_resize->resize(800, $reqHeight);

                  $image_resize->save(public_path('upload/' .$file));
                  //return "true";
              }
              else{
                  $file = Slim::saveFile($data, $name, public_path('upload/'));
                  //return "true";
              }
              $Image = new CarImage();
              $Image->selling_car_id = $car;
              $Image->image = 'upload/'.$file;
              $savedimg=$Image->save();
              //array_push($files, $output);
              if($savedimg){
                  return true;
              }
          }

      }
    }

    public static function sanitizeFileName($str) {
        // Basic clean up
        $str = preg_replace('([^\w\s\d\-_~,;\[\]\(\).])', '', $str);
        // Remove any runs of periods
        $str = preg_replace('([\.]{2,})', '', $str);
        return $str;
    }

    public function update(Request $request , $id){
    	if ($request->version == "") {
            $car_id=DB::table('cars')->where('brand','=',$request->brand)
                                        ->where('model','=',$request->model)->get();
        }
        else{
            $car_id=DB::table('cars')->where('brand','=',$request->brand)->where('model','=',$request->model)
                                        ->where('version','=',$request->version)->get();
        }

        try{
            $selling_car =SellingCar::findOrFail($id);
            $selling_car->car_id= $car_id[0]->id;

            $selling_car->make_year= $request->make_year;
            $selling_car->kms_run= $request->kms_run;
            $selling_car->engine_cc= $request->engine_cc;
            $selling_car->color= $request->color;
            $selling_car->seller_id= $request->seller_id;
            $selling_car->car_status= $request->car_status;
            $selling_car->asking_price= $request->asking_price;

            $selling_car->additional_details= $request->additional_details;
            $selling_car->post_date= Carbon::now();
            $mySave = $selling_car->update();

            $car = $selling_car->id;

            if ($mySave) {
                $saved = "false";
                $saved = $this->saveImageToProduct($car);

                if ($saved) {
                    Session::flash('flash_message', 'Car for sale details successfully updated!');

                    return redirect()->route('sellingcar.index');
                  }
                  else {
                    Session::flash('flash_message', 'car for sale details successfully updated!');

                    return redirect()->route('sellingcar.index');
                  }
                }
        }

      catch(Exception $e){
        Session::flash('flash_message', 'Car details could not be updated!');

            return redirect()->route('sellingcar.index');
      }
    }

    public function updateImage(Request $request){

        $carimg= DB::table('car_images')->where('selling_car_id', $request->pId)->get();

        $allimg = DB::table('car_images')->where('selling_car_id', '!=' ,$request->pId)->get();

        $random=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 5);

        foreach(request()->file as $f)

          $imageName = $f->getClientOriginalName();
          $filesize = $f->getSize();

          $width = Image::make($f)->width();
          $height = Image::make($f)->height();
          $reqHeight = (500/$width) * $height;

              if($filesize >= 1024)
              {
                  $filesize = number_format($filesize / 1024, 2);
                  // dd($filesize);
              }

          $count=0;
          $c= 0;

          foreach($carimg as $img){

            if ($img->image == $imageName) {
              // dd($img->product_id, $request->pId, $img->image_location, $imageName);
              $count=$count+1;
            }
          }

          if ($count==0) {
            foreach($allimg as $i){
              if ($i->image == $imageName) {

                $c = $c +1;
              }
            }

              if($c == 0){
                if(($width > 500) || ((int)$filesize > 50)){
                  $image_resize = Image::make($f->getRealPath());
                  $image_resize->resize(500, $reqHeight);
                  $image_resize->save(public_path('upload/' .$imageName));
                }
                else{
                  $f->move(public_path('upload'), $imageName);
                }

                $Image = new CarImage();
                $Image->car_id = $request->pId;
                $Image->image = 'upload/' .$imageName;



                $saveImage = $Image->save();
                return response()->json(['uploaded' => '/upload/'.$imageName]);

              }
              # code...
              return response()->json(['uploaded' => '/upload/'.$imageName]);
            }

            else{
              $newName = $random."_".$imageName;
              if(($width > 500) || ((int)$filesize > 50)){
                  $image_resize = Image::make($f->getRealPath());
                  $image_resize->resize(500, $reqHeight);
                  $image_resize->save(public_path('upload/' .$newName));
                }
                else{
                  $f->move(public_path('upload'), $newName);
                }
              $Image = new CarImage();
              $Image->car_id = $request->pId;
              $Image->image = 'upload/' .$imageName;

              $saveImage = $Image->save();

              return response()->json(['uploaded' => '/upload/'.$imageName]);

            }
         }

      public function removeImage(Request $request){
        $image_path = "upload/".$request->image;
        if(File::exists($image_path)) {

          File::delete($image_path);
        }

        $delete= DB::table('car_images')->where('selling_car_id',$request->id)
                                            ->where('image',$request->image)->delete();
        if ($delete) {
          $success="true";
          return $success;
        }
      }

    public function delete($id){
      $deleted = SellingCar::find($id);
      $done = $deleted->delete();

      if ($done) {
        Session::flash('flash_message', 'Car on sale details successfully deleted!');

        return redirect()->route('sellingcar.index');
      }
      else {
        Session::flash('flash_message', 'Car on sale details could not be deleted!');

        return redirect()->route('sellingcar.index');
      }

    }
}
