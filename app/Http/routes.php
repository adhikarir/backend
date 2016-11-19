<?php

//for image
Route::get('/image', function(){ return redirect('/image'); });
Route::resource('/image', 'ImageController');



Route::auth();

Route::get('/home', 'HomeController@index');

// Route::get('profile', ['middleware' => 'auth', function() {
//     // Only authenticated users may enter...
// }]);

 Route::get('/', function () {
    return view('welcome');
});
  Route::post('/logout', function () {
    return view('admin');
});


Route::group(['middleware'=>['web']], function(){

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

 Route::get('/product',[
	'uses'=>'ProductController@index',
	// 'as'=>'post.create',
	'middleware'=>'auth'


	]);


Route::post('product', [
	'uses'=>	'ProductController@index',
	'middleware'=>'auth'
	]);

Route::get('productform', [
	'uses'=>	'ProductController@form',
	'middleware'=>'auth'
	]);

Route::post('save', [
	'uses'=>	'ProductController@save',
	'middleware'=>'auth'
	]);

Route::post('update', [
	'uses'=>	'ProductController@update',
	'middleware'=>'auth'
	]);

Route::get('DeleteProduct/{id}', [
	'uses'=>	'ProductController@delete',
	'middleware'=>'auth'
	]);
Route::get('EditProduct/{id}', [
	'uses'=>	'ProductController@edit',
	'middleware'=>'auth'
	]);



//blog start

Route::post('blog', [
	'uses'=>	'BlogController@index',
	'middleware'=>'auth'
	]);

Route::get('blogform', [
	'uses'=>	'BlogController@form',
	'middleware'=>'auth'
	]);

Route::post('save', [
	'uses'=>	'BlogController@save',
	'middleware'=>'auth'
	]);

Route::post('update', [
	'uses'=>	'BlogController@update',
	'middleware'=>'auth'
	]);

Route::get('DeleteBlog/{id}', [
	'uses'=>	'BlogController@delete',
	'middleware'=>'auth'
	]);
Route::get('EditBlog/{id}', [
	'uses'=>	'BlogController@edit',
	'middleware'=>'auth'
	]);
//blog end




// Route::get('/image', function(){ return redirect('/image'); });
// Route::resource('/image', 'ImageController');
Route::get('/image', [
	'uses'=>	'ImageController@index',
	'middleware'=>'auth'
	]);

//for blog
Route::get('/blog', [
	'uses'=>	'BlogController@index',
	'middleware'=>'auth'
	]);


 });

Route::get('/ram', [
	'uses'=>	'NewController@showPosts',
	
	]);