<!DOCTYPE html>
<html lang="en">

  <head>
    @include('web.frontend.layout.head')
  </head>

  <body>
     <!--svg sprite all used icons-->
    <svg width="0" height="0" class="hidden d-none">
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.825 5" id="arrow-dropdown">
        <path d="M0 0l3.413 5 3.413-5z"></path>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.223 15.064" id="metro-user">
        <path
          d="M9.27 10.477v-.961a5.176 5.176 0 002.318-4.3c0-2.88 0-5.215-3.476-5.215S4.635 2.335 4.635 5.216a5.176 5.176 0 002.317 4.3v.956c-3.93.326-6.951 2.257-6.951 4.592h16.222c0-2.335-3.022-4.267-6.953-4.588z">
        </path>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.621 15.621" id="ico-search">
        <path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round"
          stroke-width="3" d="M15.167,9.833A5.333,5.333,0,1,1,9.833,4.5,5.333,5.333,0,0,1,15.167,9.833Z"
          transform="translate(-3 -3)" />
        <path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round"
          stroke-width="3" d="M27.875,27.875l-2.9-2.9" transform="translate(-14.375 -14.375)"></path>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="close">
        <path
          d="M19.373 16.344l-6.346-6.346 6.346-6.346A2.14 2.14 0 1016.346.625L10 6.971 3.654.625A2.14 2.14 0 10.627 3.652l6.346 6.346-6.346 6.346a2.14 2.14 0 103.027 3.027L10 13.025l6.346 6.346a2.14 2.14 0 103.027-3.027z">
        </path>
      </symbol>
      <symbol viewBox="0 0 6.7 11" xmlns="http://www.w3.org/2000/svg" id="ico-chevron-right">
        <path
          d="M6.5,5.3c0,0.3-0.1,0.5-0.3,0.7l-4.3,4.3c-0.4,0.4-1,0.4-1.4,0c-0.4-0.4-0.4-1,0-1.4L4,5.3L0.5,2.1c-0.4-0.4-0.4-1-0.1-1.4	c0.4-0.4,1-0.4,1.4-0.1l4.3,3.9C6.4,4.8,6.5,4.9,6.5,5.3L6.5,5.3z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.971 18.706" id="feather-eye">
        <path xmlns="http://www.w3.org/2000/svg" fill="" stroke="" stroke-linecap="round" stroke-linejoin="round"
          stroke-width="2"
          d="M1.5,14.353S5.677,6,12.986,6s11.486,8.353,11.486,8.353-4.177,8.353-11.486,8.353S1.5,14.353,1.5,14.353Z"
          transform="translate(-.5 -5)" />
        <path xmlns="http://www.w3.org/2000/svg" fill="" stroke="" stroke-linecap="round" stroke-linejoin="round"
          stroke-width="2" d="M19.765,16.632A3.132,3.132,0,1,1,16.632,13.5,3.132,3.132,0,0,1,19.765,16.632Z"
          transform="translate(-4.147 -7.279)" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.197 21.629" id="icon-google">
        <path
          d="M10.815 9.269v3.709h6.134a5.839 5.839 0 01-6.134 4.663 6.827 6.827 0 010-13.652 6.087 6.087 0 014.312 1.666l2.933-2.828A10.377 10.377 0 0010.815 0a10.815 10.815 0 000 21.629c6.242 0 10.382-4.388 10.382-10.568a9.853 9.853 0 00-.17-1.793z">
        </path>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.028 22.458" id="icon-fb">
        <path
          d="M11.24 12.633l.624-4.064h-3.9V5.931a2.032 2.032 0 012.291-2.2h1.773V.275A21.621 21.621 0 008.881 0C5.67 0 3.57 1.947 3.57 5.471v3.1H0v4.064h3.57v9.825h4.394v-9.827z">
        </path>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.992 11.992" id="feather-arrow-up-right">
        <path xmlns="http://www.w3.org/2000/svg" fill="" stroke="" stroke-linecap="round" stroke-linejoin="round"
          stroke-width="2" d="M10.5,19.664,19.664,10.5" transform="translate(-9.086 -9.086)" />
        <path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round"
          stroke-width="2" d="M10.5,10.5h9.164v9.164" transform="translate(-9.086 -9.086)" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.957 16.249" id="youtube">
        <path
          d="M3.047 15.822a47.917 47.917 0 006.432.427 47.918 47.918 0 006.432-.423 3.517 3.517 0 003.047-3.48v-8.44a3.517 3.517 0 00-3.047-3.48 48.708 48.708 0 00-12.864 0A3.517 3.517 0 000 3.906v8.436a3.517 3.517 0 003.047 3.48zM7.3 6.567a1.158 1.158 0 011.784-.975l2.654 1.693a.982.982 0 010 1.652L9.084 10.63A1.158 1.158 0 017.3 9.655z">
        </path>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" id="cancel-icon">
        <path d="M6.5 0L4 2.5 1.5 0 0 1.5 2.5 4 0 6.5 1.5 8 4 5.5 6.5 8 8 6.5 5.5 4 8 1.5z"></path>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="plus-circle">
        <path d="M8 15A7 7 0 118 1a7 7 0 010 14zm0 1A8 8 0 108 0a8 8 0 000 16z"></path>
        <path d="M8 4a.5.5 0 01.5.5v3h3a.5.5 0 010 1h-3v3a.5.5 0 01-1 0v-3h-3a.5.5 0 010-1h3v-3A.5.5 0 018 4z"></path>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.073 16.56" id="feather-layers">
        <g stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
          <path d="M8.536.75l-7.53 3.765 7.53 3.765 7.53-3.765zm-7.53 11.295l7.53 3.765 7.53-3.765"></path>
          <path d="M1.006 8.28l7.53 3.765 7.53-3.765"></path>
        </g>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.088 16.059" id="computer">
        <path
          d="M20.073 14.051a2 2 0 002-2.007l.01-10.037A2.013 2.013 0 0020.073 0H4.015a2.013 2.013 0 00-2.008 2.007v10.037a2.013 2.013 0 002.007 2.007H0v2.007h24.088v-2.007zM4.015 2.007h16.058v10.037H4.015z"
          fill="#80c78b"></path>
      </symbol>
      <symbol id="icon-book-open" viewBox="0 0 35 32">
        <path fill="none" stroke="#f6d58a" style="stroke: var(--color1, #f6d58a)" stroke-linejoin="round"
          stroke-linecap="round" stroke-miterlimit="4" stroke-width="4.0522"
          d="M2.026 2.026h9.32c3.432 0 6.213 2.782 6.213 6.213v0 21.734c0-2.573-2.086-4.659-4.659-4.659h-10.875z"></path>
        <path fill="none" stroke="#f6d58a" style="stroke: var(--color1, #f6d58a)" stroke-linejoin="round"
          stroke-linecap="round" stroke-miterlimit="4" stroke-width="4.0522"
          d="M33.086 2.026h-9.32c-3.432 0-6.213 2.782-6.213 6.213v0 21.734c0-2.573 2.086-4.659 4.659-4.659v0h10.875z">
        </path>
      </symbol>
      <symbol id="icon-awesome-play-circle" viewBox="0 0 32 32">
        <path fill="#f79f77" style="fill: var(--color1, #f79f77)"
          d="M15.999 0c-8.837 0-16.001 7.164-16.001 16.001s7.164 16.001 16.001 16.001c8.837 0 16.001-7.164 16.001-16.001v0c0-0.003 0-0.008 0-0.012 0-8.831-7.159-15.989-15.989-15.989-0.004 0-0.008 0-0.012 0h0.001zM23.464 17.548l-11.354 6.515c-0.219 0.125-0.481 0.2-0.761 0.2-0.855 0-1.549-0.693-1.551-1.548v-13.425c0.003-0.855 0.697-1.547 1.553-1.547 0.279 0 0.54 0.074 0.767 0.202l-0.008-0.004 11.354 6.902c0.475 0.272 0.79 0.775 0.79 1.352s-0.315 1.081-0.782 1.348l-0.008 0.004z">
        </path>
      </symbol>
      <symbol id="icon-feather-arrow-up-right" viewBox="0 0 32 32">
        <path fill="none" stroke="#80c78b" style="stroke: var(--color1, #80c78b)" stroke-linejoin="round"
          stroke-linecap="round" stroke-miterlimit="4" stroke-width="6.5619" d="M4.639 27.361l22.722-22.722"></path>
        <path fill="none" stroke="#80c78b" style="stroke: var(--color1, #80c78b)" stroke-linejoin="round"
          stroke-linecap="round" stroke-miterlimit="4" stroke-width="6.5619" d="M4.639 4.639h22.722v22.722"></path>
      </symbol>
      <symbol id="icon-feather-download" viewBox="0 0 32 32">
        <path fill="none" stroke="#797d83" stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="4"
          stroke-width="2.7024"
          d="M30.649 20.882v6.511c0 1.798-1.458 3.256-3.256 3.256v0h-22.787c-1.798 0-3.256-1.458-3.256-3.256v0-6.511">
        </path>
        <path fill="none" stroke="#797d83" stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="4"
          stroke-width="2.7024" d="M7.862 12.745l8.138 8.138 8.138-8.138"></path>
        <path fill="none" stroke="#797d83" stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="4"
          stroke-width="2.7024" d="M16 20.882v-19.531"></path>
      </symbol>
      <symbol id="icon-file" viewBox="0 0 23 32">
        <path fill="#7fbcf3" style="fill: var(--color1, #7fbcf3)"
          d="M20.751 0h-18.501c-1.242 0.002-2.248 1.008-2.25 2.249v27.501c0.002 1.242 1.008 2.248 2.249 2.25h18.501c1.242-0.002 2.248-1.008 2.25-2.249v-27.501c-0.002-1.242-1.008-2.248-2.249-2.25h-0zM6.498 11.505h10.001c0.552 0 1 0.448 1 1s-0.448 1-1 1h-9.999c-0.552 0-1-0.448-1-1s0.448-1 1-1v0zM5.495 17.5c0-0.552 0.447-0.999 0.999-0.999v0h10.001c0.552 0 1 0.448 1 1s-0.448 1-1 1v0h-9.996c-0.002 0-0.003 0-0.005 0-0.552 0-0.999-0.447-0.999-0.999 0-0.001 0-0.001 0-0.002v0zM17 26.5h-2.001c-0.552 0-1-0.448-1-1s0.448-1 1-1v0h2.001c0.552 0 1 0.448 1 1s-0.448 1-1 1v0z">
        </path>
      </symbol>
      <symbol id="icon-image" viewBox="0 0 35 32">
        <path fill="#f6d58a" style="fill: var(--color1, #f6d58a)"
          d="M9.090 25.454c-2.382-0.005-4.405-1.539-5.14-3.672l-0.011-0.038-0.051-0.167c-0.156-0.471-0.248-1.013-0.252-1.576v-9.919l-3.529 11.778c-0.066 0.247-0.105 0.531-0.105 0.824 0 1.51 1.014 2.784 2.398 3.177l0.023 0.006 22.491 6.023c0.251 0.068 0.539 0.107 0.837 0.107v0c0.005 0 0.011 0 0.017 0 1.483 0 2.734-0.996 3.12-2.355l0.006-0.023 1.311-4.167z">
        </path>
        <path fill="#f6d58a" style="fill: var(--color1, #f6d58a)"
          d="M13.091 10.181c1.607 0 2.91-1.303 2.91-2.91s-1.303-2.91-2.91-2.91c-1.607 0-2.91 1.303-2.91 2.91v0c0.001 1.607 1.303 2.909 2.91 2.91h0z">
        </path>
        <path fill="#f6d58a" style="fill: var(--color1, #f6d58a)"
          d="M31.272 0h-21.819c-2.002 0.007-3.622 1.628-3.629 3.629v16.008c0.007 2.002 1.628 3.622 3.629 3.629h21.819c2.002-0.007 3.622-1.628 3.629-3.629v-15.991c-0.007-2.002-1.628-3.622-3.629-3.629h-0.001zM9.453 2.91h21.819c0.402 0 0.728 0.326 0.728 0.728v0 10.324l-4.596-5.361c-0.477-0.546-1.174-0.89-1.951-0.895h-0.001c-0.78 0.004-1.476 0.359-1.939 0.914l-0.003 0.004-5.401 6.484-1.759-1.755c-0.463-0.459-1.1-0.743-1.804-0.743s-1.341 0.284-1.804 0.743l-4.013 4.013v-13.721c-0-0.003-0-0.006-0-0.009 0-0.401 0.325-0.727 0.726-0.728h0z">
        </path>
      </symbol>
    </svg>
    <!--svg sprite all used icons end-->

    <!-- onload event -->
    <div class="page__onload">
      <img src="{{asset('img/illustrations/run.gif')}}" alt="loading" class="page__onload__img">
    </div>

    <div class="page active">
      <!--all modals here-->
      @include('web.frontend.partials.modals')
      <!--******-->
      <div class="page__main">
        @include('web.frontend.layout.header')
        <div class="page__content  {{(Request::route() && Request::route()->getName() === 'home') ? '' : 'white' }}">
          @yield('content')
        </div>
        @include('web.frontend.layout.footer')
      </div>

      @include('web.frontend.partials.search')

    </div>
    @include('web.frontend.layout.header.js')
    @include('web.frontend.partials.message')
    @yield('scripts')
  </body>
</html>