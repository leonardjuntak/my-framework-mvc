<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f3f4f6;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 320px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            margin-right: 1.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        .btn-login {
            width: 100%;
            background-color: #3b82f6;
            color: #ffffff;
            padding: 0.8rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #2563eb;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 1rem;
        }

        .card-body {
            padding: 1rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="/login" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password">
                </div>
            </div>
            <button class="btn-login" type="submit">Masuk</button>
        </form>
        <div id="error-message" class="error-message"></div>
    </div>
</body>

</html>