<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Squadra extends Model
{

    protected $table = "squadra";

    //rendo tutti gli attributi mass-assignable (cioè possono essere inseriti tutti insieme contemporaneamente nel DB)
    protected $fillable = [
        'nome_completo', 'nome_abbreviato', 'logo'
    ];

    public $timestamps = false;

    //RELAZIONI DELLA TABELLA squadra

    //Relazione casa 1-N con la tabella partite_Milan 
    public function casa() {
        return $this->hasMany("App\Models\Partita","id_casa");
    }

    //Relazione trasferta 1-N con la tabella partite_Milan 
    public function trasferta() {
        return $this->hasMany("App\Models\Partita","id_trasferta");
    }

}  