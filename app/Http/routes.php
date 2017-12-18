<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/home/category/{id?}','HomeController@showAllinCategory');
Route::get('/home/language/{id?}','HomeController@showAllinLanguage');
Route::get('/aboutus', 'AboutusController@index');
Route::get('/contactus', 'ContactusController@index');
Route::post('/contactus/submit1', 'ContactusController@submitcomplaint');
Route::post('/contactus/submit2', 'ContactusController@submitsuggestion');

Route::get('/HRPanel/viewcomplaints', 'HRController@viewcomplaints');
Route::get('/HRPanel/viewsuggestions', 'HRController@viewsuggestions');
Route::get('/HRPanel', 'HRController@index');

Route::get('/item/{id?}', 'ItemController@show');		// '?' means sending the id to the controller!
Route::get('/{id?}/item', 'ItemController@show');		// '?' means sending the id to the controller!
Route::get('/search/{keyword?}', 'searchcontroller@search'); //searchcontroller 
Route::post('/item/{id}/rate','ItemController@rate');			//rate an item
Route::post('/item/{item?}/BS','ItemController@Buy'); //  order
Route::post('/item/{item?}/review','ItemController@review'); 


//  (publisher request)/ and special orders
Route::get('/home/{id?}/index','NewItemController@index');	//0 id for publish , 1 special
Route::post('/home/{id?}/Submit','NewItemController@Submit'); //submit publish request or special order
Route::get('/home/ThankYou','NewItemController@ThankYou');

//User Profile
Route::get('/myprofile', 'UserProfileController@View');
Route::get('/editprofile', 'UserProfileController@Edit');
Route::post('/editprofile/submit','UserProfileController@SubmitEdit');
Route::post('/myprofile/changepassword','UserProfileController@ChangePassword');


//Admin Home
Route::get('/AdminHome','AdminHomeController@index');
Route::get('/{customer?}/customer','AdminHomeController@ShowCustomerInfo');

Route::get('/Admin/AddPublisher','AdminHomeController@ViewAddPublisher');
Route::post('/Admin/AddPublisher/Add','AdminHomeController@AddPublisher');
//Admin Remove book
Route::post('/item/{item?}/remove','AdminHomeController@RemoveBook');
Route::get('/home/toremovebook', 'HomeController@index2');
//Admin Remove customer
Route::get('/toremoveuser','AdminHomeController@GoToRemoveUser');
Route::post('/user/remove','AdminHomeController@RemoveUser');

//Admin Publish requests and Special orders
Route::get('/{id?}/show/SS','AdminPublish_SpecialController@ShowPublish_Special'); //show Publish id:0 ,special id:1
Route::get('/{id?}/{req?}/detail','AdminPublish_SpecialController@ShowPublish_SpecialDetail');//detail Publish,sp1
Route::post('/{id?}/accept','AdminPublish_SpecialController@AcceptPublishRequest');//only for Publish
Route::post('/{id?}/refuse','AdminPublish_SpecialController@RefusePublishRequest');//only for Publish
Route::post('/{id?}/archive/S','AdminPublish_SpecialController@ArchiveSpecialOrder');//only for special

//Admin Buy requests 
Route::get('/show/BS','AdminBuyController@ShowBuy');
Route::post('/{req?}/archive/BS','AdminBuyController@ArchiveBuy_Similar');
Route::post('/{req?}/reoffer/BS','AdminBuyController@ReofferItem');





