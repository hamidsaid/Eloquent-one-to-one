<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Address;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert/{id}', function($id){
  $user = User::findOrFail($id);

  //instatiate a new address object
  $address = new Address(['name' => 'Mkuranga Pwani']);

  //relate the user with user_id (obtained from address() in User Model)
  //with this inserted address 
  //means one user has one address
  $user->address()->save($address);

});

Route::get('/read', function(){

    $address = Address::all();

    foreach($address as $address){
        echo $address->name . "<br>";
    }
});

Route::get('/update', function(){

    $address = Address::whereUserId(2)->first();

    $address->name = "Mkuranga Pwani St Matthew Street";

    $address->save();
   
});

Route::get('/delete/{id}', function($id){

    $user = User::findOrFail($id);

    $user->address()->delete();

    return 'Successfully deleted';
    
});