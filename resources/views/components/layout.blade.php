<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groceries Network</title>
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/groceries">Groceries</a>
            <a href="/groceries/create">Create New Groceries</a>
        </nav>
    </header>

    <main class="container">
        {{$slot}}
    <main>

    <footer>
        <p>&copy; 2025 Groceries Network</p>
    </footer>
</body>
</html>