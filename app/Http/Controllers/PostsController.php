<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($post)
    {
        $posts = [
            'first' => 'first',
            'second' => 'second'
        ];

        if (! array_key_exists($post, $posts)) {
            abort(404, 'not found');
        }
        return view('post', [
            'post' => $posts[$post]
        ]);
    }
}
