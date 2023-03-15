<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Layout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/extra.css')}}"/>
</head>
<body>



    <div class="con">
        <center><h2 class="text-secondary">Axtrion</h2></center>
        <center>
            <a href="{{url('/user/register')}}"><button class="btn btn-secondary">Registration</button></a>
            <a href="{{url('/user/login')}}"><button class="btn btn-secondary">Login</button></a>
        </center>

        <div>
            @yield('content')
        </div>

</body>
<script src="{{asset('/js/default.js')}}"></script>
</html>