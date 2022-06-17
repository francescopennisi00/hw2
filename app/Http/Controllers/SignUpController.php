<?php
   
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SignUpController extends Controller {

    private function countErrors($data) {

        //dichiaro l'array di stringhe di errore
        $errore = array();

        #VALIDAZIONE NOME

        //controllo che il nome inserito sia composto di sole lettere e che sia maiuscolo
        if(!preg_match('/^[A-Za-z ]{2,30}$/',$data["nome"])) {
            //se il pattern non è rispettato memorizzo l'errore (sotto forma di stringa) in un array
            $errore[] = "Nome non valido!";
        } else if (!preg_match('/^[A-Z]$/',substr($data["nome"],0,1))) {
            //se il nome non è maiuscolo memorizzo l'errore (sotto forma di stringa) in un array
            $errore[] = "Il nome deve essere maiuscolo!";
        }


        #VALIDAZIONE COGNOME

        //controllo che il cognome inserito sia composto di sole lettere e che sia maiuscolo
        if(!preg_match('/^[A-Za-z ]{2,30}$/',$data["cognome"])) {
            //se il pattern non è rispettato memorizzo l'errore (sotto forma di stringa) in un array
            $errore[] = "Cognome non valido!";
        } else if (!preg_match('/^[A-Z]$/',substr($data["cognome"],0,1))) {
            //se il cognome non è maiuscolo memorizzo l'errore (sotto forma di stringa) in un array
            $errore[] = "Il cognome deve essere maiuscolo!";
        }


        #VALIDAZIONE USERNAME

        //lo user name deve avere solo lettere minuscole o maiuscole e numeri con un numero di caratteri minimo di 1 e massimo di 20
        //preg_match controlla che una stringa rispetti un certo pattern di regular espression
        if (!preg_match('/^[a-zA-Z0-9_]{1,20}$/', $data["username"])) {
            //se il pattern non è rispettato memorizzo l'errore (sotto forma di stringa) in un array
            $errore[] = "Username non valido: inserire un numero massimo di 15 caratteri alfanumerici!";
        }
        else {
            //controllo se lo username esiste già e in tal caso memorizzo l'errore (sotto forma di stringa) in un array
            $username = User::where('username', $data['username'])->first();
            if ($username !== null) {
                $errore[] = "Username già esistente!";
            }
        }

        #VALIDAZIONE PASSWORD

        //la password deve essere di almeno 8 caratteri, in caso contrario memorizzo l'errore (sotto forma di stringa) in un array
        if (strlen($data["password"]) < 8) {
            $errore[] = "La password è troppo corta: inserire una password di almeno 8 caratteri!";
        }
        //controllo che le due password (la prima e quella di conferma) inserite siano identiche 
        if (strcmp($data["password"],$data["conferma_password"]) != 0) {
            $errore[] = "La password di conferma non coincide con la precedente!";
        }

        #VALIDAZIONE EMAIL

        //filter_var verifica che il campo email che ci viene passato sia valido (cioè rispetti il formato delle mail)
        if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errore[] = "Email non valida!";
        } 
        else {  //controllo che l'email inserita non sia stata già utilizzata
           $email = User::where('email', $data['email'])->first();
           if ($email !== null) {
               $errore[] = "Email già in uso!";
           }
        }

        return count($errore);
    }

    //FUNZIONE PER LA REGISTRAZIONE NEL DATABASE
    public function register() {

        //leggo i dati della richiesta POST alla Route relativa al controller e alla funzione
        $request = request();

        //anzichè memorizzare in chiaro la password nel DB, ne memorizzo un hash
        $password = password_hash($request['password'], PASSWORD_BCRYPT);

        if($this->countErrors($request) == 0) {
            $newUser =  User::create([
                'username' => $request['username'],

                'password' => $password,

                'name' => $request['nome'],

                'surname' => $request['cognome'],

                'email' => $request['email'],

            ]);
            //se l'inserimento nel DB ha avuto successo setto la variabile di sessione
            if ($newUser) {
                Session::put("id_user",$newUser->id);
                return redirect('community');
            } 
            else {
                return redirect('signup');
            }
        }
        else {
            return redirect('signup');
        }
        
    }  

    //FUNZIONE PER IL CONTROLLO DELL'EMAIL
    public function checkEmail($email) {
        $exist = User::where('email', $email)->exists();  //true se l'email è già in uso, false altrimenti
        return ['exists' => $exist];
    }

    //FUNZIONE PER IL CONTROLLO DELLO USERNAME
    public function checkUsername($username) {
        $exist = User::where('username', $username)->exists();  //true se lo username è già in uso, false altrimenti
        return ['exists' => $exist];
    }

}
    
?>