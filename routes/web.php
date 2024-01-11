<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FrontController;
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



Route::middleware(['lang'])->group(function () {
Route::get('/', [\App\Http\Controllers\FrontController::class, 'getHome'])->name('home');
Route::get('/about', [\App\Http\Controllers\FrontController::class, 'getAbout'])->name('about');
Route::get('/contatti', [\App\Http\Controllers\FrontController::class, 'getContatti'])->name('contatti');

Route::get('/anagrafica/{utente}', [\App\Http\Controllers\UtenteController::class, 'show'])->name('anagrafica');
Route::get('/utente/cambiopassword', [\App\Http\Controllers\UtenteController::class, 'edit']);
Route::post('/utente/cambiopassword', [\App\Http\Controllers\UtenteController::class, 'cambiaPassword']);

Route::get('/user/login', [\App\Http\Controllers\AuthController::class, 'authentication'])->name('user.login');
Route::post('/user/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('user.login');
Route::get('/user/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('user.logout');
Route::get('/user/register', [\App\Http\Controllers\AuthController::class, 'insertRegistration'])->name('user.register');
Route::post('/user/register', [\App\Http\Controllers\AuthController::class, 'registration'])->name('user.register'); 
Route::post('/verificaEmail', [\App\Http\Controllers\AuthController::class, 'verificaEmail']); 
Route::post('/verificaUsername', [\App\Http\Controllers\AuthController::class, 'verificaUsername']); 
Route::post('/checkLanguage', [\App\Http\Controllers\AuthController::class, 'checkLanguage']); 



Route::get('/prodotti',[\App\Http\Controllers\ProdottoController::class,'index']);
Route::get('/lang/{lang}', [\App\Http\Controllers\LangController::class, 'changeLanguage'])->name('setLang');

Route::get('/prodotti/dettaglio/crea',[\App\Http\Controllers\ProdottoController::class,'create']);
Route::post('/prodotti/dettaglio/crea',[\App\Http\Controllers\ProdottoController::class,'store']);
Route::get('/prodotti/dettaglio/{prodotto}',[\App\Http\Controllers\ProdottoController::class,'show']);
//per la mail
Route::post('/prodotti/dettaglio/{prodotto}',[\App\Http\Controllers\ProdottoController::class,'show']);

Route::get('/prodotti/dettaglio/{prodotto}/rimuovi',[\App\Http\Controllers\ProdottoController::class,'confermaDestroy']);
Route::delete('/prodotti/dettaglio/{prodotto}/rimuovi',[\App\Http\Controllers\ProdottoController::class,'destroy']);
Route::get('/prodotti/dettaglio/{prodotto}/modifica',[\App\Http\Controllers\ProdottoController::class,'edit']);
Route::put('/prodotti/dettaglio/{prodotto}/modifica',[\App\Http\Controllers\ProdottoController::class,'update']);
Route::post('/prodotto/{prodotto}/cambio_disponibilita',[\App\Http\Controllers\ProdottoController::class,'cambiaDisponibilita']);


Route::post('/aggiungiCarrello',[\App\Http\Controllers\CarrelloController::class,'carrello']);
Route::post('/rimuoviDaCarrello',[\App\Http\Controllers\CarrelloController::class,'rimuoviDaCarrello']);
Route::post('/modificaCarrello',[\App\Http\Controllers\CarrelloController::class,'modificaCarrello']);
Route::get('/carrello',[\App\Http\Controllers\CarrelloController::class,'myBag'])->name('carrello');
Route::post('/verificaCodiceSconto',[\App\Http\Controllers\CarrelloController::class,'verificaCodiceSconto']);

Route::get('/ordini',[\App\Http\Controllers\OrdineController::class,'index']);
Route::post('/ordine/nuovo',[\App\Http\Controllers\OrdineController::class,'create']);
//Route::get('/ordine/{ordine}/aggiornaPagamento',[\App\Http\Controllers\OrdineController::class,'pagamento']);
Route::get('/ordine/{ordine}/rimuovi',[\App\Http\Controllers\OrdineController::class,'confermaDestroy']);
Route::delete('/ordine/{ordine}/rimuovi',[\App\Http\Controllers\OrdineController::class,'destroy']);

Route::post('/ordine/{ordine}/cambio_accettazione',[\App\Http\Controllers\OrdineController::class,'view_accettazione']);
//Route::post('/ordine/{ordine}/modificaStatoAccettazione',[\App\Http\Controllers\OrdineController::class,'accettazione']);
Route::post('/confermaOrdine',[\App\Http\Controllers\OrdineController::class,'conferma']);
Route::post('/confermaOrdinePaypal',[\App\Http\Controllers\OrdineController::class,'confermaPaypal']);
Route::post('/ordini/{ordine}/statoAccettazione',[\App\Http\Controllers\OrdineController::class,'gestioneAccettazione']);


Route::post('/{ordine}/apply-two',[\App\Http\Controllers\EmailController::class, 'mailOrdine']);
Route::get('/{ordine}/apply-two-paypal',[\App\Http\Controllers\EmailController::class, 'mailOrdinePaypal']);
});
