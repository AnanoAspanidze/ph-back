@extends('web.frontend.layout')

@section('title', $topic->title)

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
        <a href="{{route('topics.inner', [$topic->id])}}" class="page__nav__list__item-link">{{$topic->title}}</a>
      </li>
    </ul>
  </div>
</section>

<div class="section__theme__container {{ class_basename($resource->resourceable_type) === 'Intro' ? 'padding-0' : '' }}">
        @php
          $path = config('resourceable.'.class_basename($resource->resourceable_type));

          if($resource->layout) {
            $page = $path['layouts'][$resource->layout];
          }else {
            $page = $path['layout'];
          }
        @endphp
        @include($page, ['topic' => $topic, 'resource' => $resource])

    @if($topic->resources)
      <div class="d-flex justify-content-center">
          <div class="paging__container sm  {{ class_basename($resource->resourceable_type) === 'Intro' ? 'margins' : '' }}">
            
            @if($previous)
            <a href="{{$previous ? route('topics.inner', [$topic->id, $previous]) : '#'}}"  @if(!$previous) aria-disabled="true"  @endif  class="paging__item bt-blue">
                <svg class="icon arrow-left">
                    <use xlink:href="#ico-chevron-right"></use>
                </svg>
            </a>
            @endif
            
            @foreach($topic->resources as $index => $item)
              <a href="{{route('topics.inner', [$topic->id, $item->id])}}" class="paging__item {{ $item->id === $resource->id ? 'active' : ''}} {{class_basename($item->resourceable_type) == 'Step' ? 'green' : ''}} ">{{$loop->index + 1}}</a>
            @endforeach
            
            @if($next)
            <a href="{{ $next ? route('topics.inner', [$topic->id, $next]) : '#' }}"  @if(!$next) aria-disabled="true"  @endif  class="paging__item bt-blue">
                <svg class="icon">
                    <use xlink:href="#ico-chevron-right"></use>
                </svg>
            </a>
            @endif
          </div>
      </div>
    @endif
</div>
@endsection