@extends('layouts.auth')

@section('title')
Регистрация
@endsection

@section('content')
<div class="input-data-form-section">
    <div class="input-data-form-header-section">
        <div class="input-data-form-header-text-up-section">
            Добро пожаловать!
        </div>
        <img src="{{ asset('img/CDM/Auth/auth_Icon_hand.png') }}" alt="">
        <div class="input-data-form-header-text-down-section">
            Пожалуйста, заполните форму
        </div>
    </div>

    <form method="POST" action="{{ route('users.register') }}">
        @csrf
        <div class="input-data-form-input-field-section">
            <label for="name">Имя</label>
            <input type="text" id="name" name="name" autocomplete="name" required>
        </div>
        <div class="input-data-form-input-field-section">
            <label for="email">Адрес электронной почты</label>
            <input type="email" id="email" name="email" autocomplete="email" required>
        </div>
        <div class="input-data-form-input-field-section">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="input-data-form-input-field-section">
            <label for="password_confirmation">Повторите пароль</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="input-data-form-switch-section">
            <a href="{{ route('rules') }}">Ознакомлен с правилами сайта</a>
            <div id="switch-btn" class="input-data-form-switch-btn-section"></div>
        </div>
        <div class="input-data-form-button-section">
            <button type="submit">Продолжить</button>
        </div>
        <div class="input-data-form-redirect-section">
            Есть аккаунт?
            <a href="{{ route('login') }}">Войти</a>
        </div>

    </form>
</div>
@endsection

@section('background')
    @parent
    Создайте аккаунт
@endsection