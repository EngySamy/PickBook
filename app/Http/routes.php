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
Route::get('/home/artschool/{id?}','HomeController@showAllinCategory');
Route::get('/home/color/{id?}','HomeController@showAllinLanguage');
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
Route::post('/item/{item?}/BS','ItemController@Buy'); // 


// offer item for sale(sell request)/ and special orders
Route::get('/home/{id?}/index','OfferItemController@index');	//0 id for sell , 1 special
Route::post('/home/{id?}/Submit','OfferItemController@Submit'); //submit sell request or special order
Route::get('/home/ThankYou','OfferItemController@ThankYou');

//User Profile
Route::get('/myprofile', 'UserProfileController@View');
Route::get('/editprofile', 'UserProfileController@Edit');
Route::post('/editprofile/submit','UserProfileController@SubmitEdit');
Route::post('/myprofile/changepassword','UserProfileController@ChangePassword');

Route::get('/{id?}/profile','ProfileItemsController@index');

//Messages
Route::get('/{id?}/inbox', 'MsgsController@Inbox');
Route::get('/{id?}/{req?}/inbox/msg', 'MsgsController@Msg');
Route::post('/{id?}/{req?}/reply', 'MsgsController@Reply'); //common for qs and customer !! 

//QS Home
Route::get('/QShome','AdminHomeController@index');
Route::get('/{customer?}/customer','AdminHomeController@ShowCustomerInfo');

//Qs Sell and Special
Route::get('/{id?}/show/SS','AdminSell_SpecialController@ShowSell_Special'); //show sell id:0 ,special id:1
Route::get('/{id?}/{req?}/detail','AdminSell_SpecialController@ShowSell_SpecialDetail');//detail sell0,sp1
Route::get('/{id?}/{req?}/serve/SS','AdminSell_SpecialController@ServeSell_Special');//serve sell0special1
Route::post('/{id?}/accept','AdminSell_SpecialController@AcceptSellRequest');//only for sell
Route::post('/{id?}/refuse','AdminSell_SpecialController@RefuseSellRequest');//only for sell
Route::get('/{id?}/{req?}/messages/SS','AdminSell_SpecialController@MsgInSell_Special');
Route::post('/{id?}/archive/S','AdminSell_SpecialController@ArchiveSpecialOrder');//only for special

//Admin Buy requests 
Route::get('/show/BS','AdminBuyController@ShowBuy');
Route::get('/{req?}/serve/BS','AdminBuyController@ServeBuy_Similar');
Route::post('/{req?}/archive/BS','AdminBuyController@ArchiveBuy_Similar');
Route::post('/{req?}/reoffer/BS','AdminBuyController@ReofferItem');





