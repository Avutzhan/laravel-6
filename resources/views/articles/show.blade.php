@extends('layouts')

@section('content')
    <!-- start section about us -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">


                    <div class="col-lg-7">
                        <div class="about-descr">
                            <h1 style="color: blue">
                                Author: {{ $article->author->name }}
                            </h1>
                            <p class="p-heading">{{ $article->title }}</p>
                            <p class="p-heading">{{ $article->excerpt }}</p>
                            <p class="p-heading">{{ $article->body }}</p>

                            <p>
                                @foreach($article->tags as $tag)
                                    <a href="{{ route('articles.index', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                                @endforeach
                            </p>

                            <h1 style="color: #0c5460">
                                Replies:
                            </h1>


                                @if($article->replies)
                                    @foreach($article->replies as $reply)
                                        <header>
                                            <p> {{ $reply->author->name }}</p>
{{--                                            $article->best_reply_id === $reply->id--}}
                                            @if($reply->isBest())
                                                <p style="color: orangered"> Best reply !!!</p>
                                            @endif
                                        </header>


                                        <h1>{{ $reply->body }}</h1>
{{--                                    update-article--}}
                                        @can('update', $article)
                                            <form method="POST" action="/best-replies/{{ $reply->id }}">
                                                @csrf
                                                <button type="submit">
                                                    Best reply
                                                </button>
                                            </form>
                                        @endcan
                                    @endforeach
                                @endif

                        </div>

                    </div>
            </div>
        </div>
    </div>
    <!-- end section about us -->
@endsection

