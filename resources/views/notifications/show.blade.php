@extends('layouts.app')

@section('content')
    <h1>show all notifications for a user</h1>
    <ul>
        @forelse($notifications as $notification)
            @if($notification->type === 'App\Notifications\PaymentReceive' )
                <li>We have received paiment from you ${{ $notification->data['amount'] / 100}}</li>
            @endif
        @empty
            <h1>you have no notes</h1>
        @endforelse
    </ul>
@endsection
