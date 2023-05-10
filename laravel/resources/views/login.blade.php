@extends('layouts.auth')

@section('title')
Авторизация
@endsection

@section('content')
<div class="input-data-form-section">
    <div class="input-data-form-header-section">
        <div class="input-data-form-header-text-up-section">
            Добро пожаловать!
        </div>
        <img src="{{ asset('img/CDM/Auth/auth_Icon_hand.png') }}" alt="">
        <div class="input-data-form-header-text-down-section">
            Пожалуйста, зайдите в свой аккаунт
        </div>
    </div>

    <form method="POST" action="{{ route('users.authenticate') }}">
        @csrf
        <div class="input-data-form-input-field-section">
            <label for="email">Адрес электронной почты</label>
            <input type="email" id="email" name="email" autocomplete="email" required>
        </div>
        <div class="input-data-form-input-field-section">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="input-data-form-button-section">
            <button type="submit">Войти</button>
        </div>
        <div class="input-data-form-redirect-section">
            Нет аккаунта?
            <a href="{{ route('register') }}">Зарегистрироваться</a>
        </div>

    </form>
</div>
@endsection