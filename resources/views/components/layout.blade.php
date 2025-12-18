<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/employees">Employees</a>
        </nav>
    </header>

    <main class="container">
        {{$slot}}
    <main>

    <footer>
        <p>&copy; 2025 Employee Management</p>
    </footer>
</body>
</html>