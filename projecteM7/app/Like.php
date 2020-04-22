<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'user_id','image_id',
    ];
    //diem quina base de dades estem editant

    protected $table= 'likes';

    //afagim la relació one to many, array amb tots els comentaris que pot tenir una image
    public function comments(){
        return $this->hasMany('\App\Comment');
    }

    //relacio one to many, array totes les images
    public function images(){
        return $this->hasMany('\App\Image');
    }

    //usuari que ens ha creat aquesta image, li pasem per parametre user_id
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}