<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 * @mixin Builder
 */

class ArticlesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //render a list of resource
        $articles = Article::latest()->get();

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

        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        //shows a view to create new resource
        return view('articles.create');
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);
        //persist new resource
        $article = new Article();

        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');

        $article->save();

        return redirect('/articles');
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
        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        //$article = Article::findOrFail($id);
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();

        return redirect('/articles/' . $article->id);
        //persist the edited resource
    }

    public function destroy()
    {
        //delete resource
    }

}
