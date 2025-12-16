<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Form')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                linear-gradient(rgba(80, 100, 220, 0.75),
                    rgba(80, 100, 220, 0.75)),
                url('/images/bg-form.jpg') center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .form-container {
            width: 100%;
            max-width: 900px;
        }

        .page-title {
            text-align: center;
            color: #fff;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .form-card {
            background: #fff;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }

        /* FORM ELEMENT */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
            display: block;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .form-textarea {
            resize: none;
            min-height: 120px;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #4a5bdc;
            box-shadow: 0 0 0 3px rgba(74, 91, 220, 0.15);
        }

        .form-error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-success {
            background: #22c55e;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
            padding: 12px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1 class="page-title">@yield('page-title')</h1>

        <div class="form-card">
            @yield('content')
        </div>
    </div>

</body>

</html>