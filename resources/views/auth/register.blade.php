@extends('layouts.main')

@section('content')
    <h3 class="mt-5">Создать учётную запись</h3>

    <form method="POST" action="{{ route('register') }}" class="mt-5">
        @csrf

        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" placeholder="Иван">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Электронная почта</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="example@gmail.com">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control @error('login') is-invalid @enderror" name="login"
                value="{{ old('login') }}" placeholder="Уникальное имя">

            @error('login')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">Подтверждение пароля</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-success" name="submit">Создать аккаунт</button>
    </form>
@endsection
