@extends('layouts.main')

@section('content')

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .page-wrapper {
            
            min-height: 100vh;
            padding: 24px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .back-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .card {
            background: #ffffff;
            border-radius: 28px;
            padding: 32px 36px;
            width: 100%;
            max-width: 720px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .label {
            color: #9e9e9e;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .title {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 4px;
            color: #111;
            line-height: 1.3;
        }

        .subtitle {
            font-size: 15px;
            color: #666;
            margin-bottom: 28px;
            word-break: break-all;
        }

        .info-row {
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 13px;
            color: #888;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #222;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Tablet */
        @media (max-width: 768px) {
            .card {
                padding: 28px 24px;
            }

            .title {
                font-size: 24px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .page-wrapper {
                padding: 16px;
            }

            .card {
                padding: 24px 20px;
                border-radius: 20px;
            }

            .title {
                font-size: 22px;
            }

            .subtitle {
                font-size: 14px;
            }

            .info-value {
                font-size: 15px;
            }
        }
    </style>


        <div class="page-wrapper">

            <a href="{{ route('admin.user.index') }}" class="back-link">← Back</a>

            <div class="card" style="margin:0 auto;">
                <div class="label">Customer</div>
                <div class="title">{{ $user->name }}</div>
                <div class="subtitle">{{ $user->email }}</div>

                <div class="info-row">
                    <div class="info-label">Role</div>
                    <div class="info-value">
                        <span class="badge" style="
                                background: {{ $user->role === 'admin' ? '#e3f2fd' : '#e8f5e9' }};
                                color: {{ $user->role === 'admin' ? '#0d47a1' : '#1b5e20' }};
                            ">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Created At</div>
                    <div class="info-value">
                        {{ $user->created_at?->format('d M Y H:i') }}
                    </div>
                </div>


            </div>

        </div>

@endsection