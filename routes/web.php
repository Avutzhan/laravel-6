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
    return view('welcome');
});
Route::get('/about', function() {
    return view('about', [
        'articles' => Article::take(2)->latest()->get()
    ]);
});
Route::get('/articles/{article}', 'ArticlesController@show');

Route::get('/articles', 'ArticlesController@index');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::put('/articles/{article}', 'ArticlesController@update');
Route::delete('/articles/{article}', 'ArticlesController@delete');
Route::post('/articles', 'ArticlesController@create');

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

