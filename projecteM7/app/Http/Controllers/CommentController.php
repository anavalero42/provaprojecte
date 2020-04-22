<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Image;
use App\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function insert(Request $request,$image_id){
        //trobem l'id del usuari
        $id =\Auth::user()->id;

        //validem les dades
        $validate = $this->validate($request, [
            'descripcio' => ['required', 'string', 'max:255'],
        ]);

        //recollim i assignem els nous valors
        $descripcio = $request->input('descripcio');
        
        
        Comment::create([
            'user_id' => $id,
            'image_id' => $image_id,
            'content' => $descripcio
        ]);

        // Retornem a la vista
        return redirect()->route('image.datail',[$image_id,]);
    }
    function delete($image_id,$comment_id){
        $id =\Auth::user()->id;

        $comment = DB::table('comments')->where('id',$comment_id)->delete();

        // Retornem a la vista
        return redirect()->route('image.datail',[$image_id]);
    }
}