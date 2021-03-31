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

Route::get('/track/{id}', 'TrackingController@track');
//auth()->loginUsingId(1);
//app()->bind('example', function( ) {
//
//    return new \App\Example();
//});
//app()->bind('App\Example', function( ) {
//    $container = new \App\Container();
//    $foo = 'foobar';
//  mailtrap
//    return new \App\Example($container, $foo);
//}); это все переносим в папку провадерс апп сервис провайдер
Route::get('/payments/create', 'ArticlesController@paymentCreate')->middleware('auth');
Route::post('/payments', 'ArticlesController@paymentStore')->middleware('auth');
Route::get('/notifications', 'ArticlesController@showNots')->middleware('auth');


Route::get('/form', 'ArticlesController@form');
Route::get('/sendmail', 'ArticlesController@sendmail');
Route::post('/sendmail', 'ArticlesController@storeemail');
Route::post('/form', 'ArticlesController@storemore');
Route::get('/posts/{post}', 'PostsController@show');

//Route::get('/', 'FruitController@index');
//Route::get('/', function(App\Example $example) {
////    $test = resolve(App\Example::class);
////    $test = app()->make(App\Example::class);
//// две вышестоящие команды это ручное вытягивание класса но можно запихать класс в аргументы функции и ларка сама все это пропишет и вытянет
//    ddd($example);
//});
Route::get('/', function() {
//    $user = App\User::first();
//
//    $post = $user->posts()->create([
//        'title' => 'foo',
//        'body' => 'lorem ipsum'
//    ]);

//    \Illuminate\Support\Facades\Cache::remember('foo', 60, function () {
//        return 'foobar';
//    });

//    return \Illuminate\Support\Facades\Cache::get('foo');

//return \Illuminate\Support\Facades\File::get(public_path('index.php'));
//return request('name');
//return \Illuminate\Support\Facades\Request::input('name');
    return view('welcome');
//    return \Illuminate\Support\Facades\View::make('welcome');

    //in tinker
    //app()->bind('key', function () { return 'here you go';});
    //resolve('key');
    //resolve('request');
    //File::get(public_path('index.php'));
    //resolve('files');
});
Route::get('/about', function() {
    return view('about', [
        'articles' => Article::take(2)->latest()->get()
    ]);
});
//article index
Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::post('/articles', 'ArticlesController@store');

Route::get('/articles/create', 'ArticlesController@create');
//article show
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show')->middleware('can:view,article');
// if you cant you standart method naming you must create new controller and you standart method naming im doing wrong bcz im hurring
Route::post('/best-replies/{reply}', 'ArticlesController@bestReplyStore');

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
Route::get('/reports', function () {
    return 'Secret reports';
})->middleware('can:view_reports');

//<img src="http://laravel-6.local/logout" alt=""> attacker
//<form action="http://laravel-6.local/logout" method="POST">
//        <button>Continue</button>
//    </form>
//form will return 419 page because laravel protects csrf attacks out of the box

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home')->middleware('auth');


//roles
//users
//john => moderator, sally => manager, frank => owner
//moderator => edit form,
//owner => view financial reports

Route::get('/add-contact-form', function() {
    return view('add-contact-form');
});

Route::post('/add-contact', function() {
    $method = "crm.contact.add";

    $name 		    = isset($_POST['name']) ? $_POST['name'] : '';
    $phone 		    = isset($_POST['phone']) ? $_POST['phone'] : '';
    $description    = isset($_POST['description']) ? $_POST['description'] : '';
    $email 			= isset($_POST['email']) ? $_POST['email'] : '';
    $company        = isset($_POST['company']) ? $_POST['company'] : '';

    $contact = array(
        'NAME' => $name,
        'PHONE' => $phone,
        'DESCRIPTION' => $description,
        'EMAIL' => $email,
        'COMPANY' => $company,
        'CONTACT_ID' => 0,
        'COMPANY_ID' => 0,
        'DEAL_ID' => 0,
    );

    function sendDataToBitrix($method, $data) {
        $queryUrl = "https://b24-nnei4t.bitrix24.ru/rest/1/c34a1uh095ffg400/" . $method ;
        $queryData = http_build_query($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $queryUrl,
            CURLOPT_POSTFIELDS => $queryData,
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, 1);
    }

    function addContact($contact) {
        $check = checkContact($contact);
        if($check['total'] != 0) return $check['result'][0]['ID'];
        $contactData = sendDataToBitrix('crm.contact.add', [
            'fields' => [
                'NAME' => $contact['NAME'],
                'EMAIL' => [['VALUE' => $contact['EMAIL'], 'VALUE_TYPE' => 'WORK']],
                'PHONE' => [['VALUE' => $contact['PHONE'], 'VALUE_TYPE' => 'WORK']],
                'TYPE_ID' => 'CLIENT',
                'COMPANY_ID' => $contact['COMPANY_ID'],
            ], 'params' => [
                'REGISTER_SONET_EVENT' => 'Y'
            ]
        ]);

        return $contactData['result'];
    }

    function checkContact($contact){
        $list = sendDataToBitrix('crm.contact.list', [
            'filter' => [ 'PHONE' =>  $contact['PHONE']],
            'select' => [ 'ID'],
        ]);
        return $list;
    }

    addContact($contact);

})->name('crm.add.contact');
