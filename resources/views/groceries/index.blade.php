<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groceries | Home</title>
</head>
<body>
    <h2>Currently Available Groceries</h2>

    @if($greeting == "hello")
        <p>Hi are you ready to list your groceries</p>
    @endif

    <ul>
        @foreach($groceries as $grocery)
            <li>
                <p>{{ $grocery['name'] }}</p>
                <a href="/groceries/{{$grocery['id']}}">
                    View Details
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>