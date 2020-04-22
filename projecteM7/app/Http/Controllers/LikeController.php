<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Image;
use App\Like;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    function save($image_id){
        // var_dump($request);
        $id =\Auth::user()->id;

        Like::create([
            'user_id' => $id,
            'image_id' => $image_id
        ]);
        // Retornem a la vista
        return redirect()->route('home');
    }
    function delete($image_id){
        // var_dump($request);
        $id =\Auth::user()->id;

        $like = DB::table('likes')->where('image_id',$image_id)->where('user_id',$id)->delete();
        // Retornem a la vista
        return redirect()->route('home');
    }
}