<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Add any additional styles or scripts here -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

       
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px; /* Adjust margin as needed */
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center text inside the form */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
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
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>BANK</h2>

    <form action="/viewregister" method="post">
        @csrf <!-- CSRF protection for Laravel -->

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>

        <br>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
