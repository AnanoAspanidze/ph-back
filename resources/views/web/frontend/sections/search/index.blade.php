@extends('web.frontend.layout')

@section('title', __('site.search_results'))

@section('content')
    
<section class="page__nav">
  <div class="container">
    <ul class="page__nav__list">
      <li class="page__nav__list__item">
        <a href="{{route('home')}}" class="page__nav__list__item-link">{{__('site.home')}}</a>
      </li>
      <li class="page__nav__list__item">
        <svg class="icon">
          <use xlink:href="#ico-chevron-right"></use>
        </svg>
      </li>
      <li class="page__nav__list__item">
        <a class="page__nav__list__item-link">{{__('site.search_results')}}</a>
      </li>
    </ul>
  </div>
</section>
<div class="search__container__content">
  <div class="container">
    <div class="row">
      <div class="col-12 page__content-col m-auto">
        <div class="search__container__row">
          <h3 class="search__container__title">{{__('site.search_text')}}</h3>
        </div>
        <form method="get" action="{{route('search')}}" class="search__container__form">
          <input type="search" name="search" value="{{$search}}" class="search__container__form__input" placeholder="ძიება">
          <a href="#">
            <svg class="icon search__icon">
              <use xlink:href="#ico-search"></use>
            </svg>
          </a>
        </form>
        <section class="search__result">
          <h1 class="search__result__title">{{__('site.found')}} (<span class="purple">{{$results}}</span>) {{__('site.result')}}</h1>
          <div class="document__line mg-sm"></div>
          <div class="search__result__section">

                @if(count($topics) > 0)
                <div>
                <h2 class="search__result__title margins">{{__('site.topics')}}</h2>
                <div class="row">
                    @foreach ($topics as $topic)
                        <div class="col-12 col-md-4 col-lg-3 resource__item__container">
                            <a href="{{route('topics.inner', [$topic->id])}}" class="theme__item">
                                <picture>
                                <source srcset="{{asset($topic->getUrlPath().'/min_'.$topic->illustration)}}" type="image/webp">
                                <source srcset="{{asset($topic->getUrlPath().'/min_'.$topic->illustration)}}" type="image/png">
                                <img src="{{asset($topic->getUrlPath().'/min_'.$topic->illustration)}}" alt="theme image" class="theme__item__img sm" />
                                </picture>
                                <h2 class="theme__item__title align-left">{!!\Illuminate\Support\Str::highlightSearch($topic->title, $search)!!}</h2>
                            </a>
                        </div>
                    @endforeach
                </div>
                @endif

                @if (count($resources) > 0 || count($abouts) > 0 )
                    <div>
                        <h2 class="search__result__title margins mt">{{__('site.recourses_and_others')}}</h2>
                        <div class="row">
                            @foreach ($resources as $resource)
                                @include(config('additionaresource.'.$resource->type.'.cardlayout'), [$resource, $search])
                            @endforeach

                            @foreach($abouts as $about)
                                @php( $about->link = route('abouts', $about->id))
                                @include(config('additionaresource.link.cardlayout'), ['resource' => $about, $search])
                            @endforeach
                        </div>
                    </div>
                @endif

          </div>
        </section>
      </div>
    </div>
  </div>
</div>
@endsection