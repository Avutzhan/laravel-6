@extends('layouts')

@section('content')
    <!-- start section about us -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">

                @foreach($article as $item)
                    <div class="col-lg-4 ">
                        <div class="div-img-bg">
                            <div class="about-img">
                                <img src="images/me.jpg" class="img-responsive" alt="me">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="about-descr">

                            <p class="p-heading">{{ $item->title }}</p>
                            <p class="p-heading">{{ $item->excerpt }}</p>
                            <p class="p-heading">{{ $item->body }}</p>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end section about us -->
@endsection

