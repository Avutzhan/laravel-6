<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
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

        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        //shows a view to create new resource
        return view('articles.create');
    }

    public function store()
    {
        //3 variant better way
        Article::create($this->validateArticle());
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
        ]);
    }

}
