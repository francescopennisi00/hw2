<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cookie extends Model
{

    //LA CONVENZIONE SUI NOMI DELLE TABELLE E' RISPETTATA

    //rendo tutti gli attributi mass-assignable (cioè possono essere inseriti tutti insieme contemporaneamente nel DB)
    protected $fillable = [
        'hash', 'id_user', 'time'
    ];

    public $timestamps = false;

    //RELAZIONI DELLA TABELLA cookies

    //Relazione 1-1 con la tabella users
    public function users() {
        return $this->belongsTo("App\Models\User");
    }

}
