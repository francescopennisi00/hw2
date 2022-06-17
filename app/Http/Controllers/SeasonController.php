<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Partita;
use App\Models\Squadra;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SeasonController extends Controller {

    public function classifica() {

        $FootballStandinsAPIEndpoint = "https://api-football-standings.azharimm.site";
        $url_fetch_classifica = $FootballStandinsAPIEndpoint . "/leagues/ita.1/standings?season=2021&sort=asc";  //FORMATO RICHIESTA GET
    
        $curl = curl_init();
    
        curl_setopt($curl,CURLOPT_URL,$url_fetch_classifica);
    
        //restituisce il risultato come stringa, ma la stringa in questione contiene la classifica già in formato json
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    
        //eseguo la fetch e metto il risultato dentro la variabile result
        $result = curl_exec($curl);
    
        curl_close($curl);
        
        echo $result;

    }

    public function calendario() {

        //FORSE SI PUO' MIGLIORARE USANDO ORM (CHIEDERE)!!!!!!

        //CON QUERY BUILDER NON SI AVREBBE UN MIGLIORAMENTO DEL CODICE PER IL FATTO CHE ANCHE ESSO IMPLICA
        //LA CONOSCENZA DELLO SCHEMA DELLE TABELLE COINVOLTE NELLA QUERY MA, NON POTENDO ASSEGNARE ALIAS ALLE TABELLE DIVENTA DIFFICILE 
        //GESTIRE IL JOIN DOPPIO CON LA TABELLA SQUADRA (CI SAREBBERO ATTRIBUTI NON IDENTIFICABILI UNIVOCAMENTE)
        //PER QUESTO USO RAW QUERIES!   ***CANCELLARE***

        //query al database per mostrare i risultati stagionali in ordine di tempo dalle più recenti alle meno recenti
        $query = "SELECT P.competizione,P.giornata,P.stadio,P.data_partita,P.orario,SC.logo AS logo_casa, 
        SC.nome_completo AS casa, P.punteggio_casa, P.punteggio_trasferta, ST.nome_completo AS trasferta, ST.logo AS logo_trasferta
        FROM partite_Milan P JOIN squadra SC ON p.id_casa = SC.id JOIN squadra ST ON P.id_trasferta = ST.id
        ORDER BY P.data_partita DESC";

        $punteggi = DB::select($query);


        //$punteggi = DB::table("partite_Milan")->join("squadra","partite_Milan.id_casa","=","squadra.id")->join("squadra","partite_Milan.id_trasferta","=","squadra.id")->orderBy("partite_Milan.data_partita","DESC")->get();
    
        
        return $punteggi;

    }

}


    
?>