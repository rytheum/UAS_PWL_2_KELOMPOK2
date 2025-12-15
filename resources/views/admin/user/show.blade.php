@extends('layouts.main')

@section('content')

    <style>
        .page-wrapper {
            background: #5f73e6;
            min-height: 100vh;
            padding: 30px;
            display: flex;
            flex-direction: column;
        }
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 40px 50px;
            max-width: 900px;
        }

        .label {
            color: #9e9e9e;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 6px;
            color: #000;
        }

        .subtitle {
            color: #555;
            margin-bottom: 30px;
        }

        .info-row {
            margin-bottom: 16px;
        }

        .info-label {
            font-size: 13px;
            color: #888;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: #222;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 600;
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