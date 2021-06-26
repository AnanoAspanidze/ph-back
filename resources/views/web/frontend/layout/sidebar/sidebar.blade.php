<nav class="header__nav">
  @if(Request::route() && (Request::route()->getName() === 'topics.inner' || Request::route()->getName() === 'topics.explanation'))
  <div class="header__nav__item">
    <a href="#" class="header__nav__btn bt-blue" data-bs-toggle="modal" data-bs-target="#tableOfConents">
      <svg class="icon feather-icon">
        <use xlink:href="#feather-layers"></use>
      </svg>
      {{__('site.content_map')}}
    </a>
  </div>
  @endif

  <div class="header__nav__menuIcon">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>
  
  <div class="header__nav__list__container">
    @if(count(config('languages')) > 1 )
    <div class="language__mobile">
      <span class="dropdown__elem--gray">ენის არჩევა: </span>
      <div class="dropdown__elem" id="language__mobile">
        <div class="dropdown__elem--inner dropdown--toggler">
          <span class="text--active dropdown--selected">
            {{app()->getLocale()}}
          </span>
            <svg class="icon">
              <use xlink:href="#arrow-dropdown"></use>
            </svg>
        </div>
        <div class="dropdown" data-for="language__mobile">
          <nav class="dropdown__nav">
            @foreach(config('languages') as $key => $language)
              <li class="dropdown__item  {{ app()->getLocale() === $key ? 'dropdown__item--active' : '' }}"><a href="{{  $key !== app()->getLocale() ? route('lang.switch', ['lang' => $key]) : '#'}}">{{$key}}</a></li>
            @endforeach
          </nav>
        </div>
      </div>
    </div>
    @endif
    
    @if(Request::route() && (Request::route()->getName() !== 'topics.inner' && Request::route()->getName() !== 'topics.explanation'))
    <ul class="header__nav__list">
      <li class="header__nav__item"><a href="{{route('abouts')}}" class="header__nav__item-link {{Request::route()->getName() === 'abouts' ? 'active' : ''}}">ჩვენზე</a></li>
      <li class="header__nav__item"><a href="{{route('topics')}}" class="header__nav__item-link {{in_array(Route::currentRouteName(), ['topics', 'topics.inner', 'topics.explanation']) ? 'active' : ''}}">თემები</a></li>
      <li class="header__nav__item"><a href="{{route('resources')}}" class="header__nav__item-link {{Request::route()->getName() === 'resources' ? 'active' : ''}}">რესურსები</a></li>
    </ul>
    @endif
    <div class="header__nav__item__footer">
      <div class="footer__contact center">
        <a href="mailto:info@school.ge" class="footer__link footer__item">info@school.ge</a>
        <div class="footer__line footer__item"></div>
        <a href="#" class="footer__item footer__contact__icon">
          <svg class="icon">
            <use xlink:href="#icon-fb"></use>
          </svg>
        </a>
        <a href="#" class="footer__item footer__contact__icon">
          <svg class="icon">
            <use xlink:href="#youtube"></use>
          </svg>
        </a>
      </div>
    </div>
  </div>
  @if(Request::route() && (Request::route()->getName() !== 'topics.inner' && Request::route()->getName() !== 'topics.explanation'))
  <div class="header__nav__item">
    <a href="{{ Auth::check() ? route('profile') : route('login') }}" class="header__nav__btn bt-blue">
      <svg class="icon">
        <use xlink:href="#metro-user"></use>
      </svg>
      @if(Auth::check())
        {{__('site.teacher')}}
      @else
        {{__('site.login')}}
      @endif
    </a>
  </div>
  <div class="header__nav__item search">
    <a href="#" class="header__nav__search">
      <svg class="icon">
        <use xlink:href="#ico-search"></use>
      </svg>
    </a>
  </div>
  @endif

  @if(count(config('languages')) > 1 )
  <div class="dropdown__elem language__desktop" id="1">
    <div class="dropdown__elem--inner dropdown--toggler">
      <span class="text--active dropdown--selected">
        {{ in_array(app()->getLocale(), array_keys(config('languages'))) ? app()->getLocale() : config('app.fallback_locale') }}
      </span>
      <svg class="icon">
        <use xlink:href="#arrow-dropdown"></use>
      </svg>
    </div>
    <div class="dropdown" data-for="1">
      <nav class="dropdown__nav">    
          @foreach(config('languages') as $key => $language)
            <li class="dropdown__item  {{ app()->getLocale() === $key ? 'dropdown__item--active' : '' }}"><a href="{{  $key !== app()->getLocale() ? route('lang.switch', ['lang' => $key]) : '#'}}">{{$key}}</a></li>
          @endforeach
      </nav>
    </div>
  </div>
  @endif
</nav>