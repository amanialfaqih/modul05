@extends('layouts.login')

@section('content')

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow" style="width: 350px;">

        <h4 class="text-center mb-3">Login</h4>

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <button class="btn btn-primary w-100">Login</button>

        </form>

    </div>

</div>

@endsection