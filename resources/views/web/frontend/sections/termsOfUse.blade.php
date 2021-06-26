@extends('web.frontend.layout')

@section('title', __('site.terms'))

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
                <a href="register.html" class="page__nav__list__item-link">{{__('site.terms')}}</a>
            </li>
        </ul>
    </section>
    <article class="document__section page__content-col">
        <h1 class="document__title"> {{__('site.terms')}} </h1>
        <p class="document__text">
            {!!__('site.terms_text')!!}
        </p>
        <div class="document__line"></div>
        <div class="document__btn__container">
            <a href="{{route('privacy')}}" class="document__btn">{{__('site.privacy_policy')}}</a>
        </div>
    </article>
</div>
@endsection