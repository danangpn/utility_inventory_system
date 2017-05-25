<?php

use App\User;
use App\Item;

Route::get('add', function(){
	$user = new User;
	$user->lname = 'Sari';
	$user->fname = 'Ida';
	$user->mname = 'Rahmania';
	$user->email = 'email@yahoo.com';
	$user->username = 'admin';
	$user->password = bcrypt('admin*1');
	$user->save();
	});
Route::get('add/{name}/{email}/{username}/{password}', function($name,$email,$username,$password){
	$user = new User;
	$user->lname = $name;
	$user->fname = $name;
	$user->mname = $name;
	$user->email = $email;
	$user->username = $username;
	$user->password = bcrypt($password);
	$user->save();
	return 'Success. Username: '.$username.' Password: '.$password;
});
Route::get('/item', function(){
	$item = new Item;
	$item->name = 'chairs';
	$item->quantity = 120;
	$item->save();
});

//Route authentication

Route::get('/', [
	'as'=> 'index',
	'uses'=> 'AuthController@main'
]);
Route::post('/login', [
	'as'=> 'login',
	'uses'=> 'AuthController@login'
]);


//Route Staff
Route::get('/main', [
	'as'=> 'staff',
	'uses'=> 'StaffController@main'
]);

Route::get('/staff/item/{item_id}', [
	'as'=> 'staff_borrow',
	'uses'=> 'StaffController@staff_borrow'
]);
Route::post('/staff/item/{item_id}', [
	'as'=> 'borrow_item',
	'uses'=> 'StaffController@borrow_item'
]);
Route::get('/staff/{item_id}/borrowed_item', [
	'as'=> 'view_borrowed_item',
	'uses'=> 'StaffController@view_borrowed_item'
]);
Route::get('/staff/{item_id}/update_quantity_item/', [
	'as'=> 'update_quantity_item',
	'uses'=> 'StaffController@update_quantity_item'
]);
Route::post('/staff/{item_id}/action_update_quantity_item/', [
	'as'=> 'action_update_quantity_item',
	'uses'=> 'StaffController@action_update_quantity_item'
]);
Route::get('/staff/{item_id}/{borrowed_id}/', [
	'as'=> 'staff_return',
	'uses'=> 'StaffController@staff_return'
]);
Route::post('/staff/additem', [
	'as'=> 'add_item',
	'uses'=> 'StaffController@add_item'
]);
Route::post('/staff/search', [
	'as'=> 'staff_search',
	'uses'=> 'StaffController@search'
]);

Route::get('/logout', [
	'as'=> 'logout',
	'uses'=>'StaffController@logout'
]);