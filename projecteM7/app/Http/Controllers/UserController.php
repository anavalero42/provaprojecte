<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class UserController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    public function config(){
        return view('config');
    }
    public function getImage($filename){

        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }
    public function update(Request $request){
        //trobem l'id del usuari
        $id =\Auth::user()->id;

        //validem les dades
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => 'required|string|max:255,nick,'.$id,
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['required', 'image']
        ]);

        //recollim i assignem els nous valors
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        
        //dades de la imatge
        $image_path = $request->file('avatar');
        //var_dump($image_path);
        if($image_path) {
            $image_path_name=time().$image_path->getClientOriginalName();
            //desem la image al storage/app/users
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            // //a la base de dades desarem el nom del archiu
            //dd($image_path);
            // $user->image = $image_path_name;
        }
        
        $usuari = DB::table('users')->where('id',$id)->update([
            'name' => $name,
            'surname' => $surname,
            'nick' => $nick,
            'email' => $email,
            'image' => $image_path_name
        ]);

        // Retornem a la vista
        return redirect()->route('config')
                ->with('estat', 'Usuari editat correctament');
    }
}
