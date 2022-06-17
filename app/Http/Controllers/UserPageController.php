<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User; 
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;   


class UserPageController extends Controller {

    public function index () {

        //SE L'UTENTE NON E' AUTENTICATO, REINDIRIZZA ALLA LOGIN
        //SE L'UTENTE E' AUTENTICATO, GENERA LA PAGINA DELL'UTENTE CON I DATI DELL'UTENTE LOGGATO E QUELLI DELL'UTENTE DELLA PAGINA
    
        //CHIARAMENTE RISOLVERE LA QUESTIONE COOKIE
    
        if(!empty(Session::get("id_user"))) {
    
            $userid_logged = Session::get("id_user");
            $user = User::find($userid_logged);
            $username_logged = $user->username;

            //leggo i parametri passati con POST
            $request = request();
            $userid = $request->id_user;

            $user_page = User::find($userid);
            $username = $user_page->username;
            $nome = $user_page->name;
            $cognome = $user_page->surname;

            //ritorno la vista della pagina dell'utente con associati i dati prelevati
            return view("user_page")->with("userid_logged",$userid_logged)->with("username_logged",$username_logged)->with("userid",$userid)->with("username",$username)->with("cognome",$cognome)->with("nome",$nome);
    
            
        } else { //se l'utente non è autenticato (variabile di sessione non attiva) rimbalza alla pagina di login
            return redirect("login");
        }
    
    }


    private function getTime($tempo) {    

        // CALCOLA IL TEMPO TRASCORSO DALLA PUBBLICAZIONE DEL COMMENTO
        //SE IL COMMENTO E' STATO CARICATO NELLA GIORNATA CORRENTE RITORNO SOLO L'ORARIO
        //SE IL COMMENTO E' STATO CARICATO IL GIORNO PRIMA, METTO RITORNO "Ieri"
        //SE IL COMMENTO E' STATO CARICATO ANCORA PRIMA, METTO LA DATA DI CARICAMENTO
        
        //strtotime prende in ingresso una stringa che descrive un certo tempo e la converte in formato Unix timestamp 
        //(numero di secondi trascorsi dall' 1 gennaio 1970 alle 00:00:00)
        //quindi salviamo in old il valore del timestamp al momento della pubblicazione del post
        $oldTimeStamp = strtotime($tempo); 

        //Carbon::now()->timestamp permette di conoscere il valore attuale del timestamp
        $curTimeStamp = Carbon::now()->timestamp;

        //in old mettiamo la data di pubblicazione (formato gg/mm/aaaa) convertendo il timestamp relativo al momento della pubblicazione
        $old = date('d/m/y', $oldTimeStamp);    

        //in new mettiamo la data attuale (formato gg/mm/aaaa) convertendo il timestamp attuale
        $new = date('d/m/y',$curTimeStamp);

        //se le due date coincidono ritorno l'orario di caricamento
        if ($old === $new) {
            return date('H:i',$oldTimeStamp);
        }

        //se il commento è stato caricato ieri (quindi la differenza tra i due timestamp è inferiore al numero di secondi in 48 ore)
        //ignoro che debba essere > del numero di secondi in 24 ore perchè questo è vero se la condizione di prima è verificata
        else if ($curTimeStamp - $oldTimeStamp < 172800) {
            return "Ieri";
        }

        //altrimenti torno la data di caricamento
        else {
            return $old; 
        }
    } 


    //FUNZIONE PER LA VISUALIZZAZIONE DEI POST DELL'UTENTE
    public function showPosts($id_utente) {

        if(!empty(Session::get("id_user"))) {

            //dichiaro l'array di post
            $posts = array();

            //query per ottenere i dati dello user e quelli del post
            $query = "SELECT P.id AS id_post, P.id_user AS id_user, P.content AS content,P.nlikes AS nlikes,P.ncomments AS ncomments,
                        U.username AS username,P.time AS time
                        FROM posts P JOIN users U ON P.id_user = U.id WHERE id_user = ? ORDER BY time DESC";

            
            $rows = DB::select($query,[$id_utente]);

            for($i=0;$i<count($rows);$i++) {
                $posts[] = array("id_post" => ($rows[$i]->id_post), "id_user" => ($rows[$i]->id_user), "content" => ($rows[$i]->content), 
                                          "nlikes" => ($rows[$i]->nlikes),"ncomments" => ($rows[$i]->ncomments), 
                                          "username" => ($rows[$i]->username), "time" => ($this->getTime($rows[$i]->time)));
            }

            echo json_encode($posts);

        } else { //se l'utente non è autenticato (variabile di sessione non attiva) rimbalza alla pagina di login
            return redirect("login");
        }
        
    }
  
              
    //VERIFICA SE L'AUTORE DEL POST E' L'UTENTE LOGGATO
    public function verifica_loggato_autore ($userid) {

        if(!empty(Session::get("id_user"))) {

            $userid_log = Session::get("id_user");

            if($userid_log == $userid) {
                echo json_encode(true);
            }
            else echo json_encode(false);

        } else { //se l'utente non è autenticato (variabile di sessione non attiva) rimbalza alla pagina di login
            return redirect("login");
        }
    }


    //FUNZIONE DI ELIMINAZIONE DI UN POST
    public function deletePost() {

        if(!empty(Session::get("id_user"))) {

            //recupero i dati passati con post
            $request = request();
            $postid = $request["id_post"];

            //prelevo l'id dell'utente loggato
            $userid = Session::get("id_user");

            //$query = "DELETE FROM posts WHERE id = $postid AND id_user = $userid";
            Post::where("id",$postid)->where("id_user",$userid)->delete();

            //ritorno alla home page community
            return redirect("community");

        } else { //se l'utente non è autenticato (variabile di sessione non attiva) rimbalza alla pagina di login
            return redirect("login");
        }
    }  


}


?>