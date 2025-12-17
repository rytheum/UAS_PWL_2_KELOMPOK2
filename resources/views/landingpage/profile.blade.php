<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - E-Commerce</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="shortcut icon" type="image/icon" href="{{ asset('assets/logo/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootsnav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <style>
        /* CSS Khusus Body Profil agar seperti yang tadi */
        body { background: #f4f7f6 !important; }
        .main-content-profile { padding: 150px 0 100px; } /* Jarak agar tidak tertutup navbar sticky */
        .profile-wrapper { display: flex; gap: 20px; }
        .sidebar-profile { width: 250px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: fit-content; }
        .content-profile { flex: 1; background: white; padding: 35px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        .form-control-custom { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; }
        .btn-save { background: #6074e1; color: white; padding: 12px 25px; border: none; border-radius: 4px; font-weight: bold; width: 100%; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: #001799ff; }
        .alert-success { background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: none; }
        .user-avatar { width: 70px; height: 70px; background: #6074e1; color: white; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: bold; }
    </style>
</head>

<body>

    <div class="top-area">
        <div class="header-area">
            <nav class="navbar navbar-default bootsnav navbar-sticky navbar-scrollspy" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">
                <div class="container">
                    <div class="attr-nav">
                        <ul>
                            <li class="nav-user">
                                <a href="{{ route('profile.index') }}"><span class="lnr lnr-user"></span></a>
                            </li>
                            <li class="nav-logout">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="lnr lnr-exit-up"></span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="/">E-Commerce.</a>
                    </div>
                    <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-center">
                            <li><a href="/">Home</a></li>
                            <li><a href="/#new-arrivals">Product</a></li>
                            <li class="active"><a href="{{ route('profile.index') }}">Profile</a></li>
                            <li><a href="/transaction">Transaction</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="container main-content-profile">
        <div class="profile-wrapper">
            
            <div class="sidebar-profile text-center">
                <div class="user-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h4 style="text-transform: capitalize;">{{ $user->name }}</h4>
                <p class="text-muted" style="font-size: 13px; margin-bottom: 20px;">{{ $user->email }}</p>
                <hr>
                <ul class="nav nav-pills nav-stacked text-left">
                    <li class="active"><a href="#" style="background: #6074e1; color: white;"> Edit Profil</a></li>
                    <li><a href="/transaction" style="color: #666;"> Pesanan Saya</a></li>
                </ul>
            </div>

            <div class="content-profile">
                <h3 style="margin-bottom: 25px;">Pengaturan Akun</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control-custom" value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" class="form-control-custom" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="form-group">
                        <label>Alamat Pengiriman</label>
                        <textarea name="address" class="form-control-custom" rows="3" placeholder="Masukkan alamat lengkap Anda..." style="resize: vertical;">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <hr style="margin: 30px 0;">
                    <h4 style="margin-bottom: 15px;">Keamanan</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="password" class="form-control-custom" placeholder="Isi jika ingin ganti">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control-custom" placeholder="Ulangi password">
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <footer id="footer" class="footer" style="background: #fff; padding: 40px 0;">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} E-Commerce. Designed by Themesine.</p>
        </div>
    </footer>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootsnav.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>

</body>
</html>