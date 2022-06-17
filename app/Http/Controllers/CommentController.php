<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User; 
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CommentController extends Controller {


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


    //FUNZIONE PER MOSTRARE I COMMENTI DI UN POST
    public function show_comments($postid) {

        if(!empty(Session::get("id_user"))) {

            //dichiaro l'array di commenti
            $arrayComments = array();

            $query = "SELECT C.id AS id_commento, P.id AS id_post, C.userid AS id_user, C.time AS time, C.text AS testo, U.username AS username
                    FROM comments C JOIN posts P ON C.postid = P.id JOIN users U ON C.userid = U.id WHERE P.id = ? ORDER BY time DESC";

            $rows = DB::select($query,[$postid]);
    
            //se la query non restituisce alcuna riga ritorno solo l'id del post in modo che venga identificato via javascript
            if (!(count($rows) > 0)) {

                echo json_encode(array(array("id_post" => $postid))); 
            //faccio questa cosa con il doppio array in modo che lato javascript possa porre "const postid = json[0].id_post sia che la
            //query non restitusca alcuna riga (nessun commento è presente nel post) sia che ne restituisca almeno una 
            //(ci sono commenti presenti nel post), tenendo conto che l'id del post è uguale per tutti i commenti

                //interrompo lo script se la condizione è verificata
                exit;
            }

            for($i=0;$i<count($rows);$i++) {

                //se l'id dello user coincide con quello dell'utente loggato ritorno un booleano al valore vero, che mi serve lato js per poter fare in modo che l'utente possa eliminare il commento. 
                //Altrimenti ritorno falso
                if ($rows[$i]->id_user == Session::get("id_user")) {
                    $delete = true;
                }
                else $delete = false;
                $arrayComments[] = array("id_comm" => $rows[$i]->id_commento, "id_post" => $postid, "id_user" => $rows[$i]->id_user,
                            "time" => ($this->getTime($rows[$i]->time)), "testo" => $rows[$i]->testo, "elimina" => $delete,
                            "username" => $rows[$i]->username);
            }

            echo json_encode($arrayComments);

        }
        else {   //se l'accesso non è autorizzato (non è settata la variabile di sessione) rimbalza alla login
            return redirect("login");
        }

    }


    //FUNZIONE DI CREAZIONE COMMENTO
    public function create_comment($postid,$contenuto) {

        if(!empty(Session::get("id_user"))) {

            $userid = Session::get("id_user");
    
            //$query = "INSERT INTO comments (userid,postid,text) VALUES ($userid,$postid,'". $contenuto ."')";
            $comment = new Comment;
            $comment->userid = $userid;
            $comment->postid = $postid;
            $comment->text = $contenuto;
            $comment->save();
    
            //recupero il numero di commenti aggiornato dal trigger (passo pure l'id del post che mi serve ad identificarlo in javascript)
            //$query_ncomments = "SELECT ncomments,id FROM posts WHERE id=$postid";
            $post = Post::find($postid);
            $ncomments = $post->ncomments;
    
            echo json_encode(array("ncomments" => $ncomments, "id" => $postid));
    
        }
        else {   //se l'accesso non è autorizzato (non è settata la variabile di sessione) rimbalza alla login
            return redirect("login");
        }
    }


    //FUNZIONE DI ELIMINAZIONE COMMENTO
    public function delete_comment($postid,$commentid) {

        if(!empty(Session::get("id_user"))) {

            $userid = Session::get("id_user"); //id dell'utente loggato 

            // $query = "DELETE FROM comments WHERE userid = $userid AND postid = $postid AND id=$commentid";
            // Comment::where("userid",$userid)->where("postid",$postid)->where("id",$commentid);
            Comment::find($commentid)->delete();

            //recupero il numero di commenti aggiornato dal trigger
            // $query_ncomments = "SELECT ncomments,id FROM posts WHERE id=$postid";
            $post = Post::find($postid);
            $ncomments = $post->ncomments;
    
            echo json_encode(array("ncomments" => $ncomments, "id" => $postid));

        } else {   //se l'accesso non è autorizzato (non è settata la variabile di sessione) rimbalza alla login
            return redirect("login");
        }
    }
             
}
                   
?>              