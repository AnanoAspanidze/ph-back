@extends('web.frontend.layout')

@section('title', __("site.about"))

@section('content')
<div class="container">
  <section class="page__nav">
    <ul class="page__nav__list">
      <li class="page__nav__list__item">
        <a href="{{route('home')}}" class="page__nav__list__item-link">{{__("site.home")}}</a>
      </li>
      <li class="page__nav__list__item">
        <svg class="icon">
          <use xlink:href="#ico-chevron-right"></use>
        </svg>
      </li>
      <li class="page__nav__list__item">
        <a href="{{route('abouts')}}" class="page__nav__list__item-link">{{__("site.about")}}</a>
      </li>
    </ul>
  </section>
</div>

<section>
    <div class="container">
        <h1 class="section__themes__title mt-3 mb-5">{{__("site.about")}}</h1>
    </div>
    <div class="about__tabs-bg">
        <ul class="nav nav-tabs about__tabs" id="aboutTabs" role="tablist">
            @foreach ($abouts as $about)
              <li class="nav-item about__item" role="presentation">
                <a href="{{'#about_'.$about->id}}" class="nav-link about__link {{ $page ? ( $page == $about->id ? 'active' : '' ) : ( $loop->first ? 'active' : '') }}" id="{{$about->id.'_tab'}}" data-bs-toggle="tab" type="button"
                  role="tab" aria-controls="{{'#about_'.$about->id}}" aria-selected="{{ $page ? ( $page == $about->id ? 'true' : false ) : ( $loop->first ? 'true' : false) }}">{{$about->title}}</a>
              </li>
            @endforeach
        </ul>
        <div class="about__tabs__border"></div>
    </div>
    <div class="container">
        <div class="row col-12 m-auto about__tabs__content">
            <div class="tab-content" id="aboutTabsContent">
                @foreach ($abouts as $about)
                    <div class="tab-pane fade {{ $page ? ( $page == $about->id ? 'show active' : '' ) : ( $loop->first ? 'show active' : '') }}" id="{{'about_'.$about->id}}" role="tabpanel" aria-labelledby="{{$about->id.'_tab'}}">
                        @include('web.frontend.sections.about.helper', ['about' => $about])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection