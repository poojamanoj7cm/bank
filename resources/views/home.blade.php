<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
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
}

.welcome-message {
    
    color: black;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 20px;
}
.balance{
    color: black;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 20px;
}

.welcome-message strong {
    font-weight: bold;
    
}

        h2 {
            text-align: center;
            color: #333;
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
    <div class="welcome-message">
        <p>Welcome, <strong>{{ $user->name }}</strong></p>
    </div>
    <div class="balance">
    <p>Current Balance: ₹{{ optional($user->account)->balance ?? 0 }}</p>
        </div>

    @yield('content')
</div>
</body>