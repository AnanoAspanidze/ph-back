@extends('web.frontend.layout')

@section('title', __("site.page_type_explanation"))

@section('content')

<section class="page__nav">
  <div class="container">
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
        <a href="{{route('topics')}}" class="page__nav__list__item-link">{{__("site.topics")}}</a>
      </li>
      <li class="page__nav__list__item">
        <svg class="icon">
          <use xlink:href="#ico-chevron-right"></use>
        </svg>
      </li>
      <li class="page__nav__list__item">
        <a href="{{route('topics.inner', $topic->id)}}" class="page__nav__list__item-link">{{$topic->title}}</a>
      </li>
    </ul>
  </div>
</section>

<div class="section__theme__container pb ">
    @include($view, ['explanation' => $explanation])
</div>
@endsection