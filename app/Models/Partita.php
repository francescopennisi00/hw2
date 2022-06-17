<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Partita extends Model
{

    protected $table = "partite_Milan";

    //rendo tutti gli attributi mass-assignable (cioè possono essere inseriti tutti insieme contemporaneamente nel DB)
    protected $fillable = [
        'competizione', 'giornata', 'data_partita', 'orario', 'stadio','id_casa','id_trasferta','punteggio_casa','punteggio_trasferta'
    ];

    public $timestamps = false;

    //RELAZIONI DELLA TABELLA partite_Milan

    //Relazione 1-N con la tabella squadra (sia per la squadra in casa che per quella in trasferta)
    public function squadra() {
        return $this->belongsTo("App\Models\Squadra");
    }

}