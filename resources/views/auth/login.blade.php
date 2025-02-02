<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            height: 100%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .illustration {
            flex: 1;
            background: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .illustration img {
            width: 80%;
            height: auto;
        }

        .form-container {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        button {
            background: #667eea;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button:hover {
            background: #5a6cd8;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-forgot a {
            text-decoration: none;
            color: #667eea;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .remember-forgot a:hover {
            color: #5a6cd8;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .social-login a {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ddd;
            border-radius: 50%;
            text-decoration: none;
            color: #333;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .social-login a:hover {
            background: #667eea;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <img src="{{ asset('images/illustration.svg') }}" alt="Illustration">
        </div>
        <div class="form-container">
            <h2>Log In</h2>
            <p style="text-align: center; color: #666; margin-bottom: 30px;">Selamat datang, silahkan masukan email dan password untuk Login</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div class="errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="Enter your email" 
                        required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password" 
                        required>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#">Forgot Password</a>
                </div>
                <button type="submit">Log In</button>
            </form>
        </div>
    </div>
</body>
</html>
