@extends('web.frontend.layout')

@section('title', "404")

@section('content')

<div class="container">
    <section class="page__nav">
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
                <a class="page__nav__list__item-link">error</a>
            </li>
        </ul>
    </section>
    <div class="row">
        <div class="col-12 m-auto">
            <div class="registration__success">
                <img src="{{asset('img/404-error.svg')}}" alt="success" class="error__img">
                <p class="registration__success__text">{{__('site.page_not_found')}}</p>
                <a href="{{route('home')}}" class="header__nav__btn form__row__btn form__row__btn-sm  w-100 bt-blue">
                    {{__('site.home_page')}}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection