@extends('layouts')

@section('content')
    <!-- start section about us -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">


                    <div class="col-lg-7">
                        <div class="about-descr">

                            <p class="p-heading">{{ $article->title }}</p>
                            <p class="p-heading">{{ $article->excerpt }}</p>
                            <p class="p-heading">{{ $article->body }}</p>

                            <p>
                                @foreach($article->tags as $tag)
                                    <a href="{{ route('articles.index', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                                @endforeach
                            </p>
                        </div>

                    </div>



            </div>
        </div>
    </div>
    <!-- end section about us -->
@endsection

