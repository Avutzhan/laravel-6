<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <h1>test</h1>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <form action="/form" method="POST" id="form">
        {{ csrf_field() }}
        <input type="text" name="text" class="form-control">
        @captcha
        <input type="submit" class="btn btn-success">
    </form>
</body>
<script>
    $(document).ready(function() {
        // $('#form').submit();
    });
</script>
</html>
