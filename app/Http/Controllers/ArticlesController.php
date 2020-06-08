<?php

namespace App\Http\Controllers;

use App\Article;
use App\Events\ProductPurschased;
use App\Mail\ContactMe;
use App\Mail\Contct;
use App\Notifications\PaymentReceive;
use App\Reply;
use App\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use function foo\func;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 * @mixin Builder
 */

class ArticlesController extends Controller
{
    public function sendmail()
    {
        return view('sendmail');
    }

    public function paymentCreate()
    {
        return view('payments.create');
    }

    public function paymentStore()
    {
        //process the payment
        //unlock the purchase
        ProductPurschased::dispatch('toy');
//        event(new ProductPurschased('toy'));
        //listeners

        //notify the user about payment
        //award achievements
        //send shareable coupon to user
    }

    public function showNots()
    {
        //in tinker
//        App\User::find(1)->notifications;
        // App\User::find(1)->notifications[0]->notifiable; returns user was notificated
//        $notifications = auth()->user()->notifications;
//        $notifications = auth()->user()->unreadNotifications;
//        $notifications->markAsRead();
//        foreach ($notifications as $notification) {
//            $notification->markAsRead();
//        }

        $notifications = tap(auth()->user()->unreadNotifications)->markAsRead();
        return view('notifications.show', [
            'notifications' => $notifications
        ]);
    }

    public function storeemail()
    {
        request()->validate(['email' => 'required|email']);

        Mail::to(request('email'))
            ->send(new Contct());

        return redirect('/sendmail')->with('message', 'email send');
    }

    public function form()
    {
        return view('captcha');
    }

    public function storemore(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => 'required|captcha'
        ]);
        return $request->all();
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (request('tag')) {
            $articles = Tag::where('name' , request('tag'))->firstOrFail()->articles;
        } else {
            //render a list of resource
            $articles = Article::latest()->get();
        }


        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Article $article)
    {
        //show a single resource
//        $article = Article::findOrFail($id);
//        dd($article->replies);
        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        //shows a view to create new resource
        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    /**
     * @param Reply $reply
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function bestReplyStore(Reply $reply)
    {
        //authorize that the current user has permission to set the best reply
        //for the conversation

        //нужно потом поменять связь на belongs to ато я поставил many to many теперь когда вытягиваю артикль от ответа
        //по идее у ответа всегда должен быть один артикль а тут многие ко многим короче изза этого приходится first использовать
        //update-article
        $this->authorize('update', $reply->articles->first());

        //then set it
        $reply->articles->first()->setBestReply($reply);

//        $reply->articles->first()->best_reply_id = $reply->id;
//        $reply->articles->first()->save();
        //redirect back
        return back();
    }


    public function store()
    {
//        dd(request()->all());
        //3 variant better way
//        Article::create($this->validateArticle());
        //4 метод
        //Article::create($this->validateArticle());
        $this->validateArticle();

        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1; //auth()->id()
        $article->save();
        $article->tags()->attach(request('tags'));

        // in tinker
        //$article->tags()->attach(1);
        //$article->tags()->attach([2, 3]);
        //$article->tags()->detach(1);
        //$tag = App\Tag::find(1);
        //$article->tags()->attach($tag);
        //$tags = App\Tag::findMany([1, 2]);
        //$article->tags()->attach($tags);
        //2 variant
//        $validate = request()->validate([
//            'title' => 'required',
//            'excerpt' => 'required',
//            'body' => 'required',
//        ]);

        //Article::create($validate);
        //persist new resource
//1 variant
//        Article::create([ validate возвращает массив такой же как и тут так что можно просто опрокинуть туда переменную валидате
//            'title' => request('title'),
//            'excerpt' => request('excerpt'),
//            'body' => request('body'),
//
//        ]);

        return redirect(route('articles.index'));
    }

    public function edit(Article $article)
    {
        //find the article associated with the id
        //$article = Article::findOrFail($id);
        //show a view to edit an existing resource
        //return view('articles.edit', ['article' => $article]);
        //better way is compact
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
        $article->update($this->validateArticle());

        return redirect($article->path());
        //persist the edited resource
    }

    public function destroy()
    {
        //delete resource
    }

    protected function validateArticle()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    }

}
