@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/CDM/App/pages/create-project.css') }}">
@endpush

@section('title')
Создать проект
@endsection

@section('content')
<div>
    Заполните поля
</div>

<form method="POST" action="{{ route('api.projects.create') }}">
    @csrf
    <div class="input-data-form-input-field-section">
        <label for="name">Название</label>
        <input type="text" id="name" name="name" autocomplete="name" required>
    </div>

    <div class="input-data-form-input-field-section">
        <label for="type">Тип проекта</label>
        <select id="type" name="type">
            <option value="ladnsat-8">Ladnsat-8</option>
            <option value="sentinal-2">Sentinal-2</option>
        </select>
    </div>

    <div class="input-data-form-button-section">
        <button type="submit">Продолжить</button>
    </div>
</form>

@endsection