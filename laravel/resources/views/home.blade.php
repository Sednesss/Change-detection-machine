@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/CDM/App/pages/home.css') }}">
@endpush

@section('title')
CDMachine
@endsection

@section('content')

<div class="content-project-info-section">
    <div class="content-project-info-2-section">
        <div class="content-project-info-2-text-section">
            <div class="content-project-info-2-text-up-section">
                О проекте
            </div>
            <div class="content-project-info-2-text-down-section">
                Change Detection Machine - это разрабатываемая информационная система, направленая на обнаружение водных объектов на спутниковых снимках и отслеживание динамики изменения, и призвана решить проблему обнаружения мест протечки трубопроводов.
            </div>
        </div>
        <div class="content-project-info-2-links-section">
            @foreach($home_button as $title => $link)
            <a href="{{ route($link) }}">{{ $title }}</a>
            @endforeach
        </div>
    </div>
    <div class="content-project-info-2-image-section">
        <img src="{{ asset('img/CDM/App/rectangle.png') }}" alt="">
    </div>

</div>
<div class="content-section-news"></div>

@endsection

