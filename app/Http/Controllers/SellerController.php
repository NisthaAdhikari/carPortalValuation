<?php

namespace App\Http\Controllers;

use App\Seller;
use Hash;
use Session;
use Redirect;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(){
    	$seller = Seller::latest()->get();
    	return view('admin.seller.index', compact('seller'));
    }

    public function showForm(){


      return view("admin.seller.form");
    }


     public function store(Request $request){
      // dd($request);
      $request->validate([
        'name' => 'required',
        'location' => 'required|max:100',
        'email' => 'required|unique:sellers',
        'number' => 'required',
        'password'=>'required'
      ]);


      $seller =new Seller();
      $seller->name= $request->name;
      $seller->location= $request->location;
      $seller->email= $request->email;
      $seller->number= $request->number;
      $seller->password = Hash::make($request->password);
      $mySave = $seller->save();


      if ($mySave) {
          Session::flash('flash_message', 'Seller successfully saved');
        return redirect()->route('seller.index');
      }
      else {
        Session::flash('flash_message', 'Seller could not be added!');

        return redirect()->route('seller.index');
      }
    }



    public function edit(Request $request,$id){


      $seller = Seller::findOrFail($id);


      return view('admin.seller.editForm', compact('seller'));
    }

    public function update(Request $request , $id){
    	$request->validate([
            'name' => 'required',
            'location' => 'required|max:100',
            'email' => 'required',
            'number' => 'required',
          ]);

      try{
        $update = Seller::findOrFail($id);

        $update->name= $request->name;
        $update->location= $request->location;
        $update->email= $request->email;
        $update->number= $request->number;
        $update->password= $request->password;
        $myUpdate = $update->update();


      if ($myUpdate) {

            Session::flash('flash_message', 'Seller details successfully updated!');

            return redirect()->route('seller.index');
          }
          else {
            Session::flash('flash_message', 'Seller details could not be updated!');

            return redirect()->route('seller.index');
          }


      }
      catch(Exception $e){
        Session::flash('flash_message', 'Seller details could not be updated!');

            return redirect()->route('seller.index');
      }
    }


     public function delete($id){
      $deleted = Seller::find($id);
      $done = $deleted->delete();

      if ($done) {
        Session::flash('flash_message', 'Seller details successfully deleted!');

        return redirect()->route('seller.index');
      }
      else {
        Session::flash('flash_message', 'Seller details could not be deleted!');

        return redirect()->route('seller.index');
      }

    }
}
