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
Route::get('/home/artschool/{id?}','HomeController@showAllinArtSchool');
Route::get('/home/color/{id?}','HomeController@showAllinColor');
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
Route::post('/item/{id?}/{item?}/BS','ItemController@Buy_Similar'); // 


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
Route::get('/QShome','QShomeController@index');
Route::get('/{customer?}/customer','QShomeController@ShowCustomerInfo');

//Qs Sell and Special
Route::get('/{id?}/show/SS','QSSell_SpecialController@ShowSell_Special'); //show sell id:0 ,special id:1
Route::get('/{id?}/{req?}/detail','QSSell_SpecialController@ShowSell_SpecialDetail');//detail sell0,sp1
Route::get('/{id?}/{req?}/serve/SS','QSSell_SpecialController@ServeSell_Special');//serve sell0special1
Route::post('/{id?}/accept','QSSell_SpecialController@AcceptSellRequest');//only for sell
Route::post('/{id?}/refuse','QSSell_SpecialController@RefuseSellRequest');//only for sell
Route::get('/{id?}/{req?}/messages/SS','QSSell_SpecialController@MsgInSell_Special');
Route::post('/{id?}/archive/S','QSSell_SpecialController@ArchiveSpecialOrder');//only for special

//Qs Buy and Similar
Route::get('/{id?}/show/BS','QSBuy_SimilarController@ShowBuy_Similar');
Route::get('/{id?}/{req?}/serve/BS','QSBuy_SimilarController@ServeBuy_Similar');
Route::post('/{id?}/{req?}/archive/BS','QSBuy_SimilarController@ArchiveBuy_Similar');
Route::get('/{id?}/{req?}/messages/BS','QSBuy_SimilarController@MsgInBuy_Similar');
Route::post('/{id?}/{req?}/reoffer/BS','QSBuy_SimilarController@ReofferItem');





