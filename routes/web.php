<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [PublicController::class, 'home'])->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//CRUD ARTICLES
Route::get('/crea/articolo', [ArticleController::class, 'create'])->name('article.create');

//images
Route::post('/articoli/caricamento/immagini', [ArticleController::class, 'uploadImages'])->name('article.uploadImage');
Route::delete('/articolo/rimuovi/immagini', [ArticleController::class, 'removeImages'])->name('article.removeImage');
Route::get('/articolo/vecchie/immagini', [ArticleController::class, 'oldImages'])->name('article.oldImage');
Route::delete('cancella/immagini/{image}', [HomeController::class, 'deleteImage'])->name('article.deleteImage');


Route::post('/salva/articolo', [ArticleController::class, 'store'])->name('article.store');

Route::get('/tutti/gli/articoli/{cate?}/{articles_category?}', [ArticleController::class, 'index'])->name('article.index');
Route::get('/show/articoli/{article}', [ArticleController::class, 'show'])->name('article.show');

//contacts work with us
Route::get('/candidati', [ContactController::class, 'index'])->name('contact.index');
Route::post('/invia/candidatura', [ContactController::class, 'store'])->name('contact.store');

//revisor only
Route::get('/revisor', [RevisorController::class, 'index'])->name('revisor.index');
Route::post('/accetta/articolo/{article}', [RevisorController::class, 'accepted'])->name('revisor.accepted');
Route::post('/rifiuta/articolo/{article}', [RevisorController::class, 'rejected'])->name('revisor.rejected');
Route::put('/ripristina/articolo/{article}', [RevisorController::class, 'undo'])->name('revisor.undo');
Route::get('/articoli/rifiutati', [RevisorController::class, 'bin'])->name('revisor.bin');
Route::delete('/articolo/eliminato/{article}', [RevisorController::class, 'delete'])->name('revisor.delete');

//search
Route::get('/search', [PublicController::class, 'search'])->name('search_results');

//user
Route::get('/pagina/utente', [HomeController::class, 'panel'])->name('user.panel');
Route::get('/i/tuoi/articoli', [HomeController::class, 'userArticles'])->name('user.index');
Route::get('/modifica/articolo/{article}', [HomeController::class, 'edit'])->name('user.article_edit');
Route::put('salva/modifiche/articolo/{article}', [HomeController::class, 'update'])->name('user.update');
Route::delete('cancella/articolo/{article}', [HomeController::class, 'delete'])->name('user.delete');

//flag icons
Route::post('/locale/{locale}', [PublicController::class, 'locale'])->name('locale');

//preferiti
Route::post('/preferito/{article}', [ArticleController::class, 'preferite'])->name('article.preferite');
Route::get('/articoli/preferiti',[ArticleController::class,'preferiteShow'])->name('article.preferite_index');

