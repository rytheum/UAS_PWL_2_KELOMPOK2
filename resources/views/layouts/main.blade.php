<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- CSS --}}
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            margin: 0;
            background: #6274e1;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #fff;
            border-radius: 30px;
            margin: 20px;
            padding: 20px;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 10px;
            color: #333;
            text-decoration: none;
        }

        .menu a.active,
        .menu a:hover {
            background: #eef1ff;
            color: #4a5bdc;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 30px;
            color: #fff;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: #fff;
            color: #333;
            padding: 20px;
            border-radius: 20px;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.25);

            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .card a {
            display: block;
            margin-top: 10px;
            font-size: 13px;
            color: #4a5bdc;
            text-decoration: none;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }


        .bottom {
            margin-top: 30px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .box {
            background: #fff;
            border-radius: 25px;
            padding: 20px;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        img {
            width: 100%;
            border-radius: 20px;
        }

        @media (max-width: 992px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .bottom {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="layout">

        {{-- SIDEBAR --}}
{{-- SIDEBAR --}}
<aside class="sidebar">
    <h3>Admin Dashboard</h3>
    <div class="menu">

        {{-- Dashboard Link --}}
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa fa-home"></i> Dashboard
        </a>

        {{-- User Link --}}
        <a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
            <i class="fa fa-users"></i> User
            {{-- Mengganti fa-box dengan fa-users, lebih sesuai --}}
        </a>

        {{-- Anda bisa menambahkan link lain di sini... --}}
        <a href="{{ route('admin.transactions.index') }}"
            class="{{ request()->routeIs('admin.transactions.index') ? 'active' : '' }}">
            <i class="fa fa-tags"></i> Billing
        </a>

        {{-- Link Logout (tetap) --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button style="background:none;border:none;padding:0;width:100%;">
                <a style="cursor:pointer">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>
            </button>
        </form>
    </div>
</aside>

        {{-- MAIN CONTENT --}}
        <main class="content">
            <div class="topbar">
                <h1>@yield('page-title')</h1>
                <i class="fa fa-user-circle fa-2x"></i>
            </div>

            @yield('content')
        </main>

    </div>

</body>

</html>