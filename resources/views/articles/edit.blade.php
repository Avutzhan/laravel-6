@extends('layouts')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.2/css/bulma.css">
@endsection
@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <h1 class="heading has-text-weight-bold is-size-4">Update Article</h1>

            <form action="/articles/{{ $article->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field">
                    <label for="title" class="label">Title</label>

                    <div class="control">
                        <input type="text" class="input" id="title" name="title" value="{{ $article->title }}">
                    </div>
                </div>

                <div class="field">
                    <label for="excerpt" class="label">Excerpt</label>

                    <div class="control">
                        <textarea class="textarea" id="excerpt" name="excerpt" >{{ $article->excerpt }}</textarea>
                    </div>
                </div>

                <div class="field">
                    <label for="body" class="label">Body</label>

                    <div class="control">
                        <textarea class="textarea" id="body" name="body" >{{ $article->body }}</textarea>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
