<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{

    //LA CONVENZIONE SUI NOMI DELLE TABELLE E' RISPETTATA


    //rendo tutti gli attributi mass-assignable (cioè possono essere inseriti tutti insieme contemporaneamente nel DB)
    protected $fillable = [
        'userid', 'postid', 'time', 'text'
    ];
    
    public $timestamps = false;

    //RELAZIONI DELLA TABELLA comments

    //Relazione 1-N con la tabella posts
    public function posts() {
        return $this->belongsTo("App\Models\Post");
    }

    //Relazione 1-N con la tabella users
    public function users() {
        return $this->belongsTo('App\Models\User');
    }

}
