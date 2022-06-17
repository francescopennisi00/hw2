<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{ 

    //LA CONVENZIONE SUI NOMI DELLE TABELLE E' RISPETTATA

    //rendo tutti gli attributi mass-assignable (cioè possono essere inseriti tutti insieme contemporaneamente nel DB)
    protected $fillable = [
        'id_user', 'time', 'nlikes', 'ncomments', 'content'
    ];
    
    public $timestamps = false;

    //RELAZIONI DELLA TABELLA posts

    //Relazione 1-N con la tabella users
    public function users() {
        return $this->belongsTo("App\Models\User");
    }

    //Relazione 1-N con la tabella comments
    public function comments() {
        return $this->hasMany('App\Models\Comment',"postid");
    }

    //Relazione likes N-N con la tabella users
    public function likes() {
        return $this->belongsToMany("App\Models\User","likes","postid","userid");
    }

}