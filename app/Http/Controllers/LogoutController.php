<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller {

    #CANCELLA I DATI DI SESSIONE E RITORNA ALLA LOGIN

    public function logout() {

        //compio le operazioni solo se è settata la variabile di sessione (accesso lecito)
        if (!empty(Session::get("id_user"))) {

            $userid = Session::get("id_user");

            // Ricerco i cookie dell'utente nel database e li elimino
            Cookie::where('id_user',$userid)->delete();

            //elimino le variabili di sessione    
            Session::flush();

            //SE NEL BROWSER SONO SETTATI DEI COOKIE LI CANCELLO
            if (isset($_COOKIE['id_user']) && isset($_COOKIE['token'])) { 
    
                // Leggo i dati dei cookie settati
                $userid = $_COOKIE['id_user'];

                //elimino i cookie dal browser
                setcookie('id_user', '');
                setcookie('token', '');

            } 

            return redirect("login");

        }
        else {
            //ritorno alla login ma senza cancellare i dati dei cookie 
            return redirect("login");
        }

    }


}       
    
?>