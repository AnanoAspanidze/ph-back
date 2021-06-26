<header class="header" id="header">
  <div class="container">
    <div class="header__container">
      <a href="{{route('home')}}" class="header__logo__container">
        <img src="{{asset('img/icons/logo.svg')}}" alt="{{__('site.home_project_name')}}" class="header__logo__img">
        <h1 class="header__logo">{{__('site.home_project_name')}}</h1>
      </a>
      @include('web.frontend.layout.sidebar.sidebar')
    </div>
  </div>
</header>