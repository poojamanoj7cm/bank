<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer</title>

    <!-- Add any additional styles or scripts here -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav li {
            display: inline;
            margin-right: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #555;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .alert {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-danger {
            background-color: #f44336;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('deposit') }}">Deposit</a></li>
            <li><a href="{{ route('withdraw') }}">Withdraw</a></li>
            <li><a href="{{ route('transfer') }}">Transfer</a></li>
            <li><a href="{{ route('statement') }}">Statement</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </nav>

    <div class="content">
        <h2>Transfer</h2>

        @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('transfer') }}" method="post">
            @csrf <!-- CSRF protection for Laravel -->
            <label for="amount">Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" step="0.01" required>


           

            <button type="submit">Transfer</button>
        </form>
    </div>
</body>

</html>
