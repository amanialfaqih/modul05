@extends('layouts.login')

@section('content')

<div class="d-flex vh-100 justify-content-center align-items-center">

    <div class="card shadow-lg p-4" style="width: 380px; border-radius: 15px;">

        <h3 class="text-center mb-3 fw-bold">Register</h3>
        <p class="text-center text-muted mb-4">Buat akun baru ✨</p>

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Nama lengkap" required>
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password (min 6 karakter)" required>
            </div>

            <button class="btn btn-success w-100">Register</button>
        </form>

        <div class="text-center mt-3">
            <small>Sudah punya akun?</small><br>
            <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm mt-1">
                Login
            </a>
        </div>

    </div>

</div>

@endsection