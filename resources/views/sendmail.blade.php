<h1>send mail</h1>
<form
    action="/sendmail"
    method="POST"
>
    @csrf

    <div>
        <label for="email">Email address</label>

        <input
            type="text"
            id="email"
            name="email"
        >

        @error('email')
            <h1>{{ $message }}</h1>
        @enderror
    </div>

    <button
        type="submit"
    >
        Email submit
    </button>

    @if(session('message'))
        <h1 style="color: green"> {{ session('message') }} </h1>
    @endif

</form>
