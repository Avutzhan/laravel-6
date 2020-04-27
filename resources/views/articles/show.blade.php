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

                        </div>

                    </div>

            </div>
        </div>
    </div>
    <!-- end section about us -->
@endsection

