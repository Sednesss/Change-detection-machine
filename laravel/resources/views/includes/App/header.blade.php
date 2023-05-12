@section('header')
<div class="header-section">
    <div class="header-menu-section">
        <div class="header-menu-logo-section">
            <a href="{{ route('home') }}"><img src="{{ asset('img/CDM/App/logo.png') }}" alt=""></a>
        </div>
        <div class="header-menu-elements-section">
            @foreach($menu as $title => $link)
            <a href="{{ route($link) }}">{{ $title }}</a>
            @endforeach
        </div>
        <div class="header-menu-auth-section">
            @foreach($auth_button as $title => $link)
            <a href="{{ route($link) }}">{{ $title }}</a>
            @endforeach
        </div>
    </div>
</div>