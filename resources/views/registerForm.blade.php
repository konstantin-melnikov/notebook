@extends('layouts.base')

@section('title', config('app.name') . ' - ' . 'Регистрация')

@section('content')
    <div class="card m-auto" style="max-width: 24rem;">
        <div class="card-header">Регистрация</div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ol>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ol>
            </div>
            @endif
            <form method="POST" action="{{ route('createUser') }}">
                @csrf
                <input
                    type="text"
                    name="email"
                    class="form-control mb-3"
                    value="{{ old('email') }}"
                    placeholder="Ваш email"
                >
                <input
                    type="password"
                    name="password"
                    class="form-control mb-3"
                    placeholder="Пароль"
                >
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control mb-3"
                    placeholder="Пароль еще раз"
                >
                <button type="submit" class="btn btn-primary mb-3 w-100">Создать</button>
                <a href="{{ route('loginForm') }}">Уже есть аккаунт</a>
        </form>
        </div>
    </div>
@endsection
