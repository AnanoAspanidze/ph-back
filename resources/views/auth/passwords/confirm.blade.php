@extends('web.frontend.layout')

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
                <a class="page__nav__list__item-link">პაროლის აღდგენა</a>
            </li>
        </ul>
    </section>
    <div class="row">
        <div class="col-12 m-auto">
            <div class="registration__success">
                <img src="{{asset('img/icons/awesome-check-circle.svg')}}" alt="success" class="registration__success__icon">
                <p class="registration__success__text">თქვენ მიერ მითითებულ ელ.ფოსტაზე მიიღებთ პაროლის აღდგენისთვის საჭირო ინსტრუქციას.</p>
            </div>
        </div>
    </div>
</div>
@endsection