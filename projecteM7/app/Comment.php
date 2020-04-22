<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'user_id','image_id','content',
    ];
    //diem quina base de dades estem editant

    protected $table= 'comments';

    //relacio one to many, array tots els likes que pot tenir una image
    public function likes(){
        return $this->hasMany('\App\Like');
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