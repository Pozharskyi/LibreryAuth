<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class = "container">
    <nav class="navbar navbar-inverse">

        <ul class="nav navbar-nav">
            <li><a href="{{ route('books.index') }}">Books</a></li>
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li><a href="{{ route('books.create') }}">Create book</a> </li>
            <li><a href="{{ route('users.create') }}">Create user</a></li>
        </ul>
    </nav>
    @yield('content')
</div>
</body>
</html>