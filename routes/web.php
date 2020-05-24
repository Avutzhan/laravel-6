<?php
use Illuminate\Support\Facades\Route;
use App\Article;
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

Route::get('/posts/{post}', 'PostsController@show');
Route::get('/', function() {
    
});
//Route::get('/', function() {
//    $user = App\User::first();
//
//    $post = $user->posts()->create([
//        'title' => 'foo',
//        'body' => 'lorem ipsum'
//    ]);
//
//
//
//    return view('welcome');
//});
Route::get('/about', function() {
    return view('about', [
        'articles' => Article::take(2)->latest()->get()
    ]);
});
Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::post('/articles', 'ArticlesController@store');

Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::put('/articles/{article}', 'ArticlesController@update');

Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::delete('/articles/{article}', 'ArticlesController@delete');

// requests GET POST PUT DELETE
// GET /articles   index
// GET /articles/id    show
// POST /articles    create
// PUT /articles/id    update
// DELETE /articles/id    delete


//GET /videos           index
//GET /videos/create    create
//POST /videos          create
//GET /videos/2         show
//GET /videos/2/edit    edit
//PUT /videos/2         update
//DELETE /videos/2/     delete

//GET /videos/subscribe
//PUT /videos/subscription create


//CSRF attacked route
Route::get('/logout', function () {
    auth()->logout();

    return 'You are now logged out';
});

//<img src="http://laravel-6.local/logout" alt=""> attacker
//<form action="http://laravel-6.local/logout" method="POST">
//        <button>Continue</button>
//    </form>
//form will return 419 page because laravel protects csrf attacks out of the box

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home')->middleware('auth');
