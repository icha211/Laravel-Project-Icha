<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ninja Network | Home</title>
</head>
<body>
    <h2>Currently Available Ninjas</h2>
    <p>{{ $greeting }}</p>
    <ul>
        <li>
        <a href="/ninjas/{{$ninjas[0]['id']}}">
            {{$ninjas[0]['name']}}
        </a>
        </li>
        <li>
        <a href="/ninjas/{{$ninjas[1]['id']}}">
            {{$ninjas[1]['name']}}
        </a>
        </li>
        <li>
        <a href="/ninjas/{{$ninjas[2]['id']}}">
            {{$ninjas[2]['name']}}
        </a>
        </li>
    </ul>
</body>
</html>