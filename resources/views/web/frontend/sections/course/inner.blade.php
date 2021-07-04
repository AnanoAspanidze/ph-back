@extends('web.frontend.layout')

@section('title', __("site.topics"))

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
        <a href="{{route('topics', ['direction'=>'teacher_resource'])}}" class="page__nav__list__item-link">{{__('site.course_topics')}}</a>
      </li>
      <li class="page__nav__list__item">
        <svg class="icon">
          <use xlink:href="#ico-chevron-right"></use>
        </svg>
      </li>
      <li class="page__nav__list__item">
        <a href="" class="page__nav__list__item-link">{{$course->topic->title}}</a>
      </li>
    </ul>
  </section>
</div>
<section>
    @include('web.frontend.sections.course.pages.'.$layout, ['course' => $course])    
</section>
@endsection