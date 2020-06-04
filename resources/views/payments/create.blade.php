@extends('layouts.app')

@section('content')
    <form action="/payments" method="POST">
        @csrf
        <button type="submit">Submit</button>
    </form>
@endsection
