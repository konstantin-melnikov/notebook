@extends('layouts.base')

@section('title', config('app.name') . ' - ' . 'Вход')

@section('content')
    <h1 class="mx-auto">Записная книжка</h1>
    <div class="card m-auto" style="max-width: 24rem;">
        <div class="card-header">Вход</div>
        <div class="card-body">
            @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ol>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ol>
            </div>
            @endif
            <form method="POST" action="{{ route('auth') }}">
                @csrf
                <input
                    type="email"
                    name="email"
                    required
                    class="form-control mb-3"
                    value="{{ old('email') }}"
                    placeholder="Your Email"
                >
                <input
                    type="password"
                    name="password"
                    required
                    class="form-control mb-3"
                    placeholder="Password"
                >
                <button type="submit" class="btn btn-primary mb-3 w-100">Войти</button>
                <a class="d-block text-center" href="{{ route('registerForm') }}">Создать аккаунт</a>
        </form>
        </div>
    </div>
@endsection
