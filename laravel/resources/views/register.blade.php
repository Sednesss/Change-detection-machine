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
            Пожалуйста, зайдите в свой аккаунт
        </div>
    </div>

    <form method="POST" action="{{ route('users.register') }}">
        @csrf
        <div class="input-data-form-input-field-section">
            <label for="name">Имя</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-data-form-input-field-section">
            <label for="email">Адрес электронной почты</label>
            <input type="email" id="email" name="email" required>
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
            <label for="switch-btn">
                <a href="{{ route('rules') }}">Ознакомлен с правилами сайта</a>
            </label>
            <div id="switch-btn" class="input-data-form-switch-btn-section"></div>
        </div>
        <div class="input-data-form-button-section">
            <button type="submit">Войти</button>
        </div>
        <div class="input-data-form-redirect-section">
            <label for="switch-btn">Есть аккаунт?</label>
            <a href="{{ route('login') }}">Войти</a>
        </div>

    </form>
</div>
@endsection