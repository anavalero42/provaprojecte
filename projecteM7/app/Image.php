<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'user_id','image_path','description',
    ];
    //diem quina base de dades estem editant

    protected $table= 'images';

    //afagim la relació one to many, array amb tots els comentaris que pot tenir una image
    public function comments(){
        return $this->hasMany('\App\Comment')->orderby('id','desc');
    }

    //relacio one to many, array tots els likes que pot tenir una image
    public function likes(){
        return $this->hasMany('\App\Like');
    }

    //usuari que ens ha creat aquesta image, li pasem per parametre user_id
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
