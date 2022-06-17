<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Notizia extends Model
{

    protected $table = "notizia";

    //rendo tutti gli attributi mass-assignable (cioè possono essere inseriti tutti insieme contemporaneamente nel DB)
    protected $fillable = [
        'immagine', 'titolo', 'informazione', 'fonte', 'data_pubblicazione', 'ora_pubblicazione'
    ];

    public $timestamps = false;

    //LA TABELLA NON PRESENTA ALCUNA RELAZIONE CON ALTRE TABELLE


}