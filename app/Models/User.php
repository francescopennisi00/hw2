<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{

    //LA CONVENZIONE SUI NOMI DELLE TABELLE E' RISPETTATA

    //rendo tutti gli attributi mass-assignable (cioè possono essere inseriti tutti insieme contemporaneamente nel DB)
    protected $fillable = [
        'username', 'password', 'name', 'surname', 'email'
    ];

    public $timestamps = false;

    //RELAZIONI DELLA TABELLA users

    //Relazione 1-N con la tabella posts
    public function posts() {
        return $this->hasMany("App\Models\Post","id_user");
    }

    //Relazione 1-N con la tabella comments
    public function comments() {
        return $this->hasMany('App\Models\Comment',"userid");
    }

    //Relazione 1-1 con la tabella cookies
    public function cookies() {
        return $this->hasOne('App\Models\Cookie',"id_user");

    }

    //Relazione likes N-N con la tabella posts
    public function likes() {
        return $this->belongsToMany("App\Models\Post","likes","userid","postid");
    }
}
