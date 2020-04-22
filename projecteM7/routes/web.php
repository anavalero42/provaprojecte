<?php

use Illuminate\Support\Facades\Route;
use App\Image;  //importem el model image

Route::get('/', function () {
    //obtenim totes les images
    // $images = Image::all();
    // foreach ($images as $image) {

    //     echo $image->image_path. "<br/>";
    //     echo $image->description."<br/>";
    //     echo $image->user->name.' '.$image->user->surname;
    //     echo "<br/>";
    //     if(count($image->comments)>=1){
    //         foreach($image->comments as $comment){
    //             echo $comment->user->name.' '.$comment->user->surname.': ' ;
    //             echo $comment->content.'<br/>';

    //         }
    //     }
    //     echo "<hr/>";
    // }
    // die();
    return view('welcome');
});

Auth::routes();
// Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'ImageController@llistar')->name('home');
Route::get('/config', 'UserController@config')->name('config'); //configuració usuari
Route::post('/user/update', 'UserController@update')->name('user.update'); //actualitzar usuari
Route::post('/user/imatge', 'UserController@imatge')->name('user.imatge');

//avatar
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');

//pujar imatges
Route::get('/uploadimage', 'ImageController@index')->name('uploadimage');
Route::post('/user/upload', 'ImageController@insert')->name('user.upload');

//likes
Route::get('/like/{image_id}', 'LikeController@save')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@delete')->name('like.delete');

//detall
Route::get('/datail/{image_id}', 'ImageController@detall')->name('image.datail');

//comentaris
Route::post('/user/comment/{image_id}', 'CommentController@insert')->name('user.comment');
Route::get('/user/uncomment/{image_id}/{comment_id}', 'CommentController@delete')->name('user.uncomment');