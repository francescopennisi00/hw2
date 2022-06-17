<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User; 
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class LikeController extends Controller {

    //VERIFICA SE L'UTENTE LOGGATO HA MESSO LIKE AL POST
    public function verificaLike($idpost) {

        if(!empty(Session::get("id_user"))) {

            $userid = Session::get('id_user');
    
            //$query = "SELECT * FROM likes WHERE userid = $userid AND postid = $postid";
    
            $user = User::find($userid);
            $likes = $user->likes()->where("postid",$idpost)->get();
        
            //passo nel json l'id del post (convertito a intero) per poterlo identificare in javascript
        
            if (count($likes) > 0) {  
                return array("id_post" => $idpost, "like" => true); 
            }
            else {
                return array("id_post" => $idpost, "like" => false); 
            } 

        }
        else {  //se l'utente non è autenticato rimbalza alla login
            return redirect("login");
        }

    }

    //LIKE AL POST
    public function like($postid) {

        if(!empty(Session::get("id_user"))) {

            $userid = Session::get('id_user');

            //$query = "INSERT INTO likes VALUES($userid,$postid)";
            $user = User::find($userid);
            $user->likes()->attach($postid);
    
    
            //recupero il numero di like aggiornato dal trigger (passo pure l'id del post che mi serve ad identificarlo in javascript)
            //$query_nlikes = "SELECT nlikes,id FROM posts WHERE id=$postid";
            $post = Post::find($postid);
            if ($post) {
                return array("nlikes" => $post->nlikes, "id" => $postid);
            }

        } else {  //se l'utente non è autenticato rimbalza alla login
            return redirect("login");
        }


    }


    //UNLIKE AL POST
    public function unlike($postid) {

        if(!empty(Session::get("id_user"))) {

            $userid = Session::get('id_user');

            //$query = "DELETE FROM likes WHERE userid = $userid AND postid = $postid";
            $user = User::find($userid);
            $user->likes()->detach($postid);
    
            //recupero il numero di like aggiornato dal trigger
            //$query_nlikes = "SELECT nlikes,id FROM posts WHERE id=$postid";
            $post = Post::find($postid);
            if ($post) {
                return array("nlikes" => $post->nlikes, "id" => $postid);
            }

        } else {  //se l'utente non è autenticato rimbalza alla login
            return redirect("login");
        }

          
    }


    //FUNZIONE DI VISUALIZZAZIONE DEGLI UTENTI CHE HANNO MESSO LIKE AL POST
    public function show_likes($postid) {

        if(!empty(Session::get("id_user"))) {

            $query = "SELECT L.postid AS postid, U.username AS username, L.userid AS userid FROM likes L JOIN users U ON L.userid = U.id WHERE L.postid = ?";

            $rows = DB::select($query,[$postid]);
    
            return $rows;

        } else {  //se l'utente non è autenticato rimbalza alla login
        return redirect("login");
        }
    
    }
   
}      

?>