@extends('layouts')

@section('content')
    <!-- start section about us -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">

                @foreach($articles as $article)
                    <div class="col-lg-7">
                        <div class="about-descr">

                            <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>
                            <p class="p-heading">{{ $article->excerpt }}</p>
                            <p class="p-heading">{{ $article->body }}</p>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end section about us -->
@endsection

