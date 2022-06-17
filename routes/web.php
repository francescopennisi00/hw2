<?php          

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {  //FACCIO IN MODO CHE LA PRIMA PAGINA DEL SITO SIA LA HOME
    return view('home');
});
//route per il caricamento delle notizie nella home page del sito
Route::get("update","App\Http\Controllers\HomeController@update");
//route per la restituzione delle notizie cercate tramite il form nella home page
Route::post("search","App\Http\Controllers\HomeController@search");
//route per la generazione della pagina web dinamica della notizia al click su di essa
Route::post("news","App\Http\Controllers\HomeController@news");

//FORSE E' MEGLIO FARLA POST SE TROVO IL MODO DI PASSARE LO CSRF TOKEN DA JS (DOPO AVER RISOLTO (ANCHE IN NEWS.JS OLTRE CHE IN HOMECONTROLLER) ATTACCAREA QUELLE IN ALTO)
//route per la il caricamento dei dati della notizia nella pagina ad essa relativa
Route::get("news/show/{id}","App\Http\Controllers\HomeController@show_news");   




Route::get("stagione",function () {
    return view("stagione");
});
//route per il caricamento della classifica tramite fetch da javascript
Route::get("stagione/classifica","App\Http\Controllers\SeasonController@classifica");
//route per il caricamento del calendario stagionale tramite fetch da javascript
Route::get("stagione/calendario","App\Http\Controllers\SeasonController@calendario");



//route per la gestione dei dati del form della signup
Route::post("register","App\Http\Controllers\SignUpController@register");
//route per il controllo dell'email
Route::get("register/check_email/{email}","App\Http\Controllers\SignUpController@checkEmail");
//route per il controllo dello username
Route::get("register/check_username/{username}","App\Http\Controllers\SignUpController@checkUsername");
//route per la generazione della pagina di registrazione 
Route::get("signup",function() {
    return view("signup");
});


Route::get('login',function() {
    return view("login");
});
//route per fare in modo che se l'utente è già autenticato porta alla home page della community
Route::get('login/auth',"App\Http\Controllers\LoginController@auth");
//route per l'autenticazione dei dati inviati col form di login
Route::post('login',"App\Http\Controllers\LoginController@checkLogin");
//route per la generazione della pagina di login con i messaggi di errore 
Route::get('login/errore',function(){
    return view('login-errore');
}); 


Route::get('logout',"App\Http\Controllers\LogoutController@logout");



//route per la generazione della pagina home della community (con le informazioni sull'utente loggato nella barra in alto)
Route::get('community',"App\Http\Controllers\CommunityController@index");
//route per generare la pagina di creazione del post
Route::get('community/create_post',"App\Http\Controllers\CommunityController@index_createPost");
//route per il caricamento dei post nella pagina home della community
Route::get('community/getposts',"App\Http\Controllers\CommunityController@getPosts");
//route per la creazione di un post
Route::post('community/create_post',"App\Http\Controllers\CommunityController@createPost");
//route per mostrare le informazioni dell'utente loggato nella pagina di creazione di un post
Route::get('community/create_post/mostra_dati_utente',"App\Http\Controllers\CommunityController@showInfo");



//route per la verifica se l'utente loggato ha messo like al post
Route::get('community/post/verifica_like/{idpost}',"App\Http\Controllers\LikeController@verificaLike");
//route per mettere like a un post
Route::get('community/post/like_post/{idpost}',"App\Http\Controllers\LikeController@like");
//route per togliere like a un post
Route::get('community/post/unlike_post/{idpost}',"App\Http\Controllers\LikeController@unlike");
//route per visualizzare gli utenti che hanno messo like a un post
Route::get('community/post/show_likes/{postid}','App\Http\Controllers\LikeController@show_likes');



//route per la visualizzazione dei commenti di un post
Route::get("community/post/show_comments/{postid}","App\Http\Controllers\CommentController@show_comments");
//route per la pubblicazione di un commento ad un post
Route::get("community/post/create_comment/{postid}/{content}","App\Http\Controllers\CommentController@create_comment");
//route per l'eliminazione di un commento ad un post
Route::get("community/post/delete_comment/{postid}/{idcommento}","App\Http\Controllers\CommentController@delete_comment");



//Route per la generazione della pagina web dinamica dell'utente al click sullo username
Route::post("community/user_page","App\Http\Controllers\UserPageController@index");
//Route per la visualizzazione dei post dell'utente della pagina
Route::get("community/user/showposts/{iduser}","App\Http\Controllers\UserPageController@showPosts");
//Route per la verifica che l'autore del post è l'utente loggato
Route::get("community/user/post/verifica_loggato_autore/{iduser}","App\Http\Controllers\UserPageController@verifica_loggato_autore");
//route per l'eliminazione di un post
Route::post('community/elimina_post',"App\Http\Controllers\UserPageController@deletePost");






   