@section('header')
<div class="header-section">
    <div class="header-menu-section">
        <div class="header-menu-logo-section">
            <a href="{{ route('home') }}"><img src="{{ asset('img/CDM/App/logo.png') }}" alt=""></a>
        </div>
        <div class="header-menu-elements-section">
            @foreach($menu as $element_menu)
            <a href="{{ route('home') }}">{{ $element_menu }}</a>
            @endforeach
        </div>
        <div class="header-menu-auth-section">
            @if (Auth::check())
            <a href="{{ route('users.logout') }}">Выйти</a>
            @else
            <a href="{{ route('login') }}">Войти</a>
            @endif

        </div>
    </div>
</div>