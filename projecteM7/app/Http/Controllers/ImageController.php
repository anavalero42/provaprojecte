<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function index(){
        return view('pujar_imatge');
    }
    public function insert(Request $request){
        //trobem l'id del usuari
        $id =\Auth::user()->id;

        //validem les dades
        $validate = $this->validate($request, [
            'descripcio' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image']
        ]);

        //recollim i assignem els nous valors
        $descripcio = $request->input('descripcio');
        
        //dades de la imatge
        $image_path = $request->file('image');
        //var_dump($image_path);
        if($image_path) {
            $image_path_name=time().$image_path->getClientOriginalName();
            //desem la image al storage/app/users
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            // //a la base de dades desarem el nom del archiu
            //dd($image_path);
            // $usuari->image = $image_path_name;
        }
        
        Image::create([
            'user_id' => $id,
            'image_path' => $image_path_name,
            'description' => $descripcio
        ]);

        // Retornem a la vista
        return redirect()->route('uploadimage')
                ->with('estat', 'Imatge pujada correctament');
    }

    public function llistar(){

        $images = Image::orderBy('id','desc')->paginate(5);
        // $images = Image::all();
        // var_dump($images);
        // foreach ($images as $image) {
        //     var_dump($image->image_path);
        // }
        // $images = Image::all();
        // var_dump($images->image_path);

        return view('home')
            ->with('images', $images);
    }
    public function getImage($filename){

        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }

    public function detall($image_id){
        $images = Image::orderBy('id','desc')->paginate(5);
        // var_dump($images);
        return view('detail')
            ->with('images', $images)
            ->with('image_id', $image_id);
    }

}