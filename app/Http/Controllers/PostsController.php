<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function show($id)
    {
        return view('post', [
            'post' => Post::where('id', $id)->firstOrFail()
        ]);
    }
}
