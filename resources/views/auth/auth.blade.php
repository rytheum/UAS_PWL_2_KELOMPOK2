<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login & Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            transition: opacity .3s ease;
        }

        .form-container form {
            height: 100%;
            padding: 0 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container input {
            width: 100%;
            margin: 8px 0;
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            background: #eee;
            outline: none;
        }

        .form-container small {
            color: red;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .form-container button {
            background: #512da8;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            margin-top: 10px;
            cursor: pointer;
        }

        .sign-in {
            left: 0;
            opacity: 1;
            z-index: 2;
        }

        .sign-up {
            left: 0;
            opacity: 0;
            z-index: 1;
            pointer-events: none;
        }

        .container.active .sign-in {
            opacity: 0;
            pointer-events: none;
        }

        .container.active .sign-up {
            opacity: 1;
            z-index: 2;
            pointer-events: auto;
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, #5c6bc0, #512da8);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 150px 0 0 100px;
        }

        .toggle-content {
            text-align: center;
            padding: 0 30px;
        }

        .toggle-content button {
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
            padding: 10px 40px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container {{ session('show') === 'register' ? 'active' : '' }}" id="container">

    {{-- REGISTER --}}
<div class="form-container sign-up">
    <form method="POST" action="{{ route('register.process') }}">
        @csrf
        <h1>Create Account</h1>

        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
        @error('name') <small>{{ $message }}</small> @enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email') <small>{{ $message }}</small> @enderror

        <input type="password" name="password" placeholder="Password">
        @error('password') <small>{{ $message }}</small> @enderror

        {{-- INI YANG KURANG --}}
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
        @error('password_confirmation') <small>{{ $message }}</small> @enderror

        <button type="submit">Sign Up</button>
    </form>
</div>


{{-- LOGIN --}}
<div class="form-container sign-in">
    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <h1>Sign In</h1>

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email') <small>{{ $message }}</small> @enderror

        <input type="password" name="password" placeholder="Password">
        @error('password') <small>{{ $message }}</small> @enderror

        @if(session('login_error'))
            <small>{{ session('login_error') }}</small>
        @endif

        <button type="submit">Sign In</button>
    </form>
</div>


    {{-- TOGGLE --}}
    <div class="toggle-container">
        <div class="toggle-content">
            <h1 id="toggleTitle">Welcome Back!</h1>
            <p id="toggleText">Please login to continue</p>
            <button id="toggleBtn">Sign Up</button>
        </div>
    </div>

</div>

<script>
    const container = document.getElementById('container');
    const toggleBtn = document.getElementById('toggleBtn');
    const toggleTitle = document.getElementById('toggleTitle');
    const toggleText = document.getElementById('toggleText');

    toggleBtn.onclick = () => {
        container.classList.toggle('active');

        if (container.classList.contains('active')) {
            toggleTitle.innerText = 'Hello, Friend!';
            toggleText.innerText = 'Register with your details';
            toggleBtn.innerText = 'Sign In';
        } else {
            toggleTitle.innerText = 'Welcome Back!';
            toggleText.innerText = 'Please login to continue';
            toggleBtn.innerText = 'Sign Up';
        }
    }
</script>

</body>
</html>
