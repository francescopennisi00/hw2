<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User; 
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommunityController extends Controller {

    public function index() {

        //SE L'UTENTE NON E' AUTENTICATO, REINDIRIZZA ALLA LOGIN
        //SE L'UTENTE E' AUTENTICATO, GENERA LA PAGINA HOME COMMUNITY CON I DATI DELL'UTENTE LOGGATO

        //CHIARAMENTE RISOLVERE LA QUESTIONE COOKIE

        if(!empty(Session::get("id_user"))) {

            $session_userid = Session::get("id_user");
            $user = User::find($session_userid);

            if($user === null) {
                return redirect("login");
            }
            else {
                $userid = $user->id;
                $username = $user->username;
                return view("community")->with("userid",$userid)->with("username",$username);   
            }

        }
        //se l'utente accede da URL /community e ha un cookie attivo può accedere senza dover rifare il login
        else if (isset($_COOKIE['id_user']) && isset($_COOKIE['token'])) { 

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
        else { 
            return redirect("login");
        } 

    }

    private function getTime($tempo) {    

        // CALCOLA IL TEMPO TRASCORSO DALLA PUBBLICAZIONE DEL POST
        //SE IL POST E' STATO CARICATO NELLA GIORNATA CORRENTE RITORNO SOLO L'ORARIO
        //SE IL POST E' STATO CARICATO IL GIORNO PRIMA, METTO RITORNO "Ieri"
        //SE IL POST E' STATO CARICATO ANCORA PRIMA, METTO LA DATA DI CARICAMENTO
        
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

        //se il post è stato caricato ieri (quindi la differenza tra i due timestamp è inferiore al numero di secondi in 48 ore)
        //ignoro che debba essere > del numero di secondi in 24 ore perchè questo è vero se la condizione di prima è verificata
        else if ($curTimeStamp - $oldTimeStamp < 172800) {
            return "Ieri";
        }

        //altrimenti torno la data di caricamento
        else {
            return $old; 
        }
    }  

       

    public function getPosts() {

        if(!empty(Session::get("id_user"))) {

            //preleva dal database gli ultimi 100 post o tutti, se sono meno di 100

            //dichiaro l'array di post
            $posts = array();
    
            //query per ottenere i dati dei vari post
            $query = "SELECT P.id AS id_post, P.id_user AS id_user, P.content AS content,P.nlikes AS nlikes,P.ncomments AS ncomments,
                  U.username AS username,P.time AS time
                  FROM posts P JOIN users U ON P.id_user = U.id  ORDER BY time DESC LIMIT 100";

            $rows = DB::select($query);
    
            for($i=0;$i<count($rows);$i++) {
                $posts[] = array("id_post" => ($rows[$i]->id_post), "id_user" => ($rows[$i]->id_user), "content" => ($rows[$i]->content), 
                                          "nlikes" => ($rows[$i]->nlikes),"ncomments" => ($rows[$i]->ncomments), 
                                          "username" => ($rows[$i]->username), "time" => ($this->getTime($rows[$i]->time)));
            }

            echo json_encode($posts);
        }
        else {
            return redirect("login");
        }

    }


    //FUNZIONE PER RIDIREZIONARE VERSO LA PAGINA DI CREAZIONE DI UN POST
    public function index_createPost() {
        
        if(!empty(Session::get("id_user"))) {

            return view("create_post");  

        } else {
            return redirect("login");
        }
    }


    //FUNZIONE DI CREAZIONE DI UN NUOVO POST
    public function createPost() {

        if(!empty(Session::get("id_user"))) {

            //ricevo i dati dal form (provenienti dalla textarea) e inserisco nel DB e reinderizzo nella home page community
            $request = request();
            $contenuto = $request["content"];

            $userid = Session::get("id_user");

            //$query = "INSERT INTO posts (id_user,nlikes,ncomments,content) VALUES ($userid,0,0,'". $contenuto ."')";
            $post = new Post;
            $post->id_user = $userid;
            $post->nlikes = 0;
            $post->ncomments = 0;
            $post->content = $contenuto;
            $post->save();

            return redirect("community");

        } else {
            return redirect("login");
        }
    
    }


    //FUNZIONE PER MOSTRARE I DATI DELL'UTENTE LOGGATO NELLA PAGINA DI CREAZIONE DI UN NUOVO POST
    public function showInfo() {

        if(!empty(Session::get("id_user"))) {

            $userid = Session::get("id_user");

            //$query = "SELECT name,surname,username FROM users WHERE id=$userid";
            $user = User::find($userid);
            $name = $user->name;
            $surname = $user->surname;
            $username = $user->username;
             
            echo json_encode(array("name" => $name, "surname" => $surname, "username" => $username));


        } else {
            return redirect("login");
        }

    } 


}
    
?>                      