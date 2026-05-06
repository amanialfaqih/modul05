@extends('layouts.login')

@section('content')

<div class="d-flex vh-100 justify-content-center align-items-center">

    <div class="text-center">

        <h2 class="mb-4">Selamat Datang di Amani Bookstore</h2>

        <a href="{{ route('login') }}" class="btn btn-primary me-2">
            Login
        </a>

        <a href="{{ route('register') }}" class="btn btn-success">
            Register
        </a>

    </div>

</div>

@endsection