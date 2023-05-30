@extends('layouts.main')

@section('content')
    <h3 class="mt-5">Войти</h3>

    <form method="POST" action="{{route('login')}}" class="mt-5">
        @csrf
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

        <button type="submit" class="btn btn-success" name="submit">Войти</button>
    </form>
@endsection