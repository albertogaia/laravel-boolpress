<?php

use App\Http\Controllers\Admin\CustomController;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

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

/* Rotta che gestisce la homepage visibile agli utenti */
Route::get('/', 'HomeController@index')->name('index');
Route::get('/vue-posts', 'HomeController@listPostsApi')->name('list-posts-api');

Route::resource('/posts', 'PostController');

Route::get('/contact', 'HomeController@contact')->name('contacts');
Route::post('/contact', 'HomeController@handleContactForm')->name('contacts.send');
Route::get('/thank-you', 'HomeController@thankYou')->name('guest.thank-you');


/* Serie di rotte che gestiscono il meccanismo di autenticazione */
Auth::routes();

/* Serie di rotte che gestiscono il backoffice */
Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')
->group(function(){
    //pagina di atterraggio dopo il login (con il prefix, l'url è /admin)
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/posts', 'PostController');
    Route::resource('/tags', 'TagController');

    // Rotte per la pagina profilo
    Route::get('profile', 'HomeController@profile')->name('profile');
    Route::post('generate-token', 'HomeController@generateToken')->name('generate_token');
});
