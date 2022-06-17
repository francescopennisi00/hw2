<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class LoginController extends Controller {

    public function checkLogin() {

        //prelevo i dati passati dal form con metodo POST
        $request = request();

        #CONTROLLO CHE ESISTA UN UTENTE CON LE CRDENZIALI FORNITE

        $user = User::where("username",$request["username"])->first();

        if($user !== null) {  //se esiste un utente registrato con lo username fornito

            //adesso verifico se la password è stata inserita correttamente
            #password_verify trasforma la stringa password nel suo hash, che è un'altra stringa, 
            //e confronta quest'ultimo con quello memorizzato nel DB
            $hash = $user->password;
            if (password_verify($request["password"],$hash)) {

                //SE L'UTENTE VUOLE ESSERE RICORDATO IMPOSTO UN COOKIE DI 3 GIORNI

                //RIVEDERE LA PARTE DEL COOKIE

                if(isset($request["remember"])) {

                    //genero un stringa randomica di 12 byte (un token) e la metto in $token
                    $token = random_bytes(12);
                    // Per motivi di sicurezza, memorizzo nel DB un hash anzichè il token
                    $hash = password_hash($token, PASSWORD_BCRYPT);

                    //setto la durata del cookie di 3 giorni 
                    //(mettendo la data e l'ora di esattamente tre giorni da ora ma in formato timestamp Unix )
                    $time =  strtotime("+3 day");

                    //inserimento nella tabella cookies
                    $cookie = new Cookie;
                    $cookie->hash = $hash;
                    $cookie->id_user = $user->id;
                    $cookie->time = $time;
                    $cookie->save();

                    setcookie("id_user", $user->id, $time);
                    setcookie("token", $token, $time);

                    //imposto anche delle variabili di sessione per la sessione corrente
                    Session::put("id_user",$user->id);

                }

                //SE L'UTENTE NON VUOLE ESSERE RICORDATO IMPOSTO SOLAMENTE UNA SESSIONE
                else {
                    Session::put("id_user",$user->id);
                }

                #reindirizzo verso la home community
                return redirect("community");

            } 

            else {
                //reindirizzo alla pagina di login con i messaggi di errore
                return redirect("login/errore");
            }

        }

        else {
           //reindirizzo alla pagina di login con i messaggi di errore
           return redirect("login/errore");
        }

    }

    //FUNZIONE DI AUTENTICAZIONE E GENERAZIONE DELLA VIEW
    public function auth() {

        //FORSE DA MODIFICARE NELLA GESTIONE DEI COOKIE

        //controllo se è settata o meno la variabile di sessione 
        $var = session("id_user",false);  //ritorna false se la variabile di sessione non è settata
        if ($var === false) {
            if (isset($_COOKIE['id_user']) && isset($_COOKIE['token'])) { 

                //variabile di flag settata a false (= non c'è alcun cookie dell'utente valido)
                $flag = false;
                
                $userid =  $_COOKIE['id_user'];

                // Prendo i cookie che corrispondono all'id dello user
                $cookie = Cookie::where('id_user',$userid)->get();
                if (count($cookie) > 0) {

                    for($i=0;$i<count($cookie);$i++) {

                        // Se scaduto, lo elimino
                        if(Carbon::now()->timestamp > ($cookie[$i]->time)) {  
                            $cookie[$i]->delete();
                        }

                        // Altrimenti, controllo che il token sia valido
                        else if (password_verify($_COOKIE['token'], $cookie[$i]->hash)) {
                            //se valido impongo il flag = true e imposto la variabile di sessione
                            $flag = true;
                            Session:: put("id_user",$_COOKIE["id_user"]);
                      }

                    }

                    //al termine del ciclo, se il flag è vero posso accedere alla home page community perchè un cookie dell'utente era valido
                    if($flag === true) {
                        return redirect("community");
                    }
                }
            }
            else return redirect("login");
        } else {
            return redirect("community"); //ridireziono verso la home page community perchè la variabile di sessione è già settata (utente loggato)
        }
    }
}
    
?>                              