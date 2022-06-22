<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Notizia;
use App\Models\News;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {
    
    //FUNZIONE DI AGGIORNAMENTO DELLE NOTIZIE
    public function update() {

        /*SE SI USA MYSQL O MONGODB IL JS CAMBIA PERCHE' CAMBIA L'ID*/

        /* 
        MYSQL

        //query al database per mostrare fino a 50 notizie in ordine di tempo dalle più recenti alle meno recenti
        $arrayNotizie = Notizia::orderBy("data_pubblicazione","DESC")->orderBy("ora_pubblicazione","DESC")->limit(50)->get();

        */

        /* MONGODB */

        //query al database per mostrare fino a 50 notizie in ordine di tempo dalle più recenti alle meno recenti
        $arrayNotizie = News::orderBy("data_pubblicazione","DESC")->orderBy("ora_pubblicazione","DESC")->limit(50)->get();
        
        echo json_encode($arrayNotizie);
        // se uso mysql basta return $arrayNotizie;

    }

    //FUNZIONE DI RICERCA DELLE NOTIZIE
    public function search() {

        //leggo i dati inviati con POST alla route realativa al Controller e alla funzione
        $request = request();
        //l'escape delle stringhe è automatico
        $modalita = $request["modalita"];
        $valore = $request["object"];

        /*
        SE SI USA MYSQL O MONGODB IL JS CAMBIA PERCHE' CAMBIA L'ID

        MYSQL

        //query al database per mostrare le notizie in ordine di tempo dalle più recenti alle meno recenti
        if ($modalita === "author") {

            $notizie = Notizia::where("fonte","LIKE","%".$valore."%")->orderBy("data_pubblicazione","DESC")->orderBy("ora_pubblicazione","DESC")->get();
            //Ritorna i risultati (conversione automatica in json)
            return $notizie;

        }
        else {
            $notizie = Notizia::where("titolo","LIKE","%".$valore."%")->orderBy("data_pubblicazione","DESC")->orderBy("ora_pubblicazione","DESC")->get(); 
            //Ritorna i risultati (conversione automatica in json)
            return $notizie;
        }

        */

        /*MONGODB*/

        //query al database per mostrare le notizie in ordine di tempo dalle più recenti alle meno recenti
        if ($modalita === "author") {

            $notizie = News::where("fonte","regexp","/.*".$valore."/i")->orderBy("data_pubblicazione","DESC")->orderBy("ora_pubblicazione","DESC")->get();
            //Ritorna i risultati 
            echo json_encode($notizie);

        }
        else {
            $notizie = News::where("titolo","regexp","/.*".$valore."/i")->orderBy("data_pubblicazione","DESC")->orderBy("ora_pubblicazione","DESC")->get(); 
            //Ritorna i risultati
            echo json_encode($notizie);
        }

        
    }

    //FUNZIONE PER LA GENERAZIONE DELLA PAGINA DINAMICA DELLA NOTIZIA
    public function news() {

        //leggo i dati inviati con POST alla route realativa al Controller e alla funzione
        $request = request();

        //prelevo l'id della notizia passato alla route
        $id_notizia = $request["id_notizia"];

        //ridireziono alla view della notizia passandole l'id della notizia
        return view("news")->with("id_notizia",$id_notizia);

    }

    //FUNZIONE PER IL CARICAMENTO DEI DATI DELLA NOTIZIA NELLA PAGINA AD ESSA RELATIVA
    public function show_news($id_notizia) {

        /*
        SE SI USA MYSQL O MONGODB IL JS CAMBIA PERCHE' CAMBIA L'ID

        MYSQL

       //query al database per prelevare la notizia
       $notizia = Notizia::find($id_notizia);

       //ritorno la notizia (conversione automatica in json)
       return $notizia;

       */

       /*MONGODB*/

       //query al database per prelevare la notizia
       $notizia = News::find($id_notizia);

       //ritorno la notizia 
       echo json_encode($notizia);



    }

}     
    
?>
