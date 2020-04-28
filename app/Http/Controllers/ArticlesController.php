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
    public function show($id)
    {
        //show a single resource
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        //shows a view to create new resource
    }

    public function store()
    {
        //persist new resource
    }

    public function edit()
    {
        //show a view to edit an existing esource
    }

    public function update()
    {
        //persist the edited resource
    }

    public function destroy()
    {
        //delete resource
    }

}