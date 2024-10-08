@if (Auth::check())
    @include('navigation-menu')
@else
    @include('public-navigation-menu')
@endif