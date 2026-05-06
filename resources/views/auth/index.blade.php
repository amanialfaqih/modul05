@extends('layouts.login')

@section('content')

<div class="d-flex vh-100 justify-content-center align-items-center">

    <div class="card shadow-lg p-4" style="width: 380px; border-radius: 15px;">

        <h3 class="text-center mb-3 fw-bold">Login</h3>
        <p class="text-center text-muted mb-4">Selamat datang kembali 👋</p>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button class="btn btn-primary w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <small>Belum punya akun?</small><br>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm mt-1">
                Register
            </a>
        </div>

    </div>

</div>

@endsection