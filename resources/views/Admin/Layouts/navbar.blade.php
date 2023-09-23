<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/adminNavbar.css')}}">
    </head>

    <body>
        <nav class="navbar">
            <ul class="nav-list">
                <li><a href="">Home</a></li>
                <li><a href="">Marks</a></li>
                <li><a href="">Reading Content</a></li>
                <li><a href="{{ route('show.question.answer') }}">Question Answer</a></li>
                <li><a href="">Users List</a></li>
                <li><a href=""><img src="{{ asset('img/profilePic.png') }}" alt=""></a></li>
            </ul>
        </nav>

    </body>
</html>