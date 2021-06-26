@extends('web.frontend.layout')

@section('title', __('site.resources'))

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
        <a href="{{route('resources')}}" class="page__nav__list__item-link">{{__('site.resources')}}</a>
      </li>
    </ul>
  </section>
  <section>
    <h1 class="section__themes__title mt-3 mb-5">{{__('site.resources')}}</h1>
    <div class="resources__page">
      <div class="filter__container">
        <div class="filter__row">
          <h2 class="filter__title">{{__('site.filter')}}</h2>
          <img src="{{asset('img/icons/filter-white.svg')}}" alt="filter" class="filter__icon">
        </div>
        <div class="filter__line"></div>
        <form class="filter__form" id="filter" method="get" action="{{route('resources')}}">
          <div class="filter__form__section">
            <h3 class="filter__form__section__title">{{__('site.direction')}}</h3>
            <label class="checkbox-container">
              <input type="checkbox" name="direction[]" value="student_resource" @if($direction && in_array('student_resource', $direction)) checked="checked" @endif>
              <span class="checkmark"></span>
              {{__('site.student_recourse')}}
            </label>
            <label class="checkbox-container">
              <input type="checkbox" name="direction[]" value="teacher_resource" @if($direction && in_array('teacher_resource', $direction)) checked="checked" @endif>
              <span class="checkmark"></span>
              {{__('site.teacher_recourse')}}
            </label>
          </div>
          <div class="filter__form__section">
            <h3 class="filter__form__section__title">{{__('site.recourse_type')}}</h3>
            <label class="checkbox-container">
              <input type="checkbox" name="image" @if(in_array('image', $types)) checked="checked" @endif>
              <span class="checkmark"></span>
              {{__('site.image')}}
            </label>
            <label class="checkbox-container">
              <input type="checkbox" name="link" @if(in_array('link', $types)) checked="checked" @endif>
              <span class="checkmark"></span>
              {{__('site.url')}}
            </label>
            <label class="checkbox-container">
              <input type="checkbox" name="video" @if(in_array('video', $types)) checked="checked" @endif>
              <span class="checkmark"></span>
              {{__('site.video')}}
            </label>
            <label class="checkbox-container">
              <input type="checkbox" name="pdf" @if(in_array('pdf', $types)) checked="checked" @endif>
              <span class="checkmark"></span>
              {{__('site.pdf')}}
            </label>
            <label class="checkbox-container">
              <input type="checkbox" name="game" @if(in_array('game', $types)) checked="checked" @endif>
              <span class="checkmark"></span>
              {{__('site.game')}}
            </label>
            <label class="checkbox-container">
              <input type="checkbox" name="exercise" @if(in_array('exercise', $types)) checked="checked" @endif>
              <span class="checkmark"></span>
              {{__('site.exercise')}}
            </label>
          </div>
          <div class="filter__form__section">
            <h3 class="filter__form__section__title">{{__('site.topics')}}</h3>
            
            @foreach ($topics as $item)
              <label class="checkbox-container">
                <input type="checkbox" name="topic[]" class="topic__input" value="{{$item->id}}" @if( $topic &&  in_array($item->id, $topic)) checked="checked" @endif>
                <span class="checkmark"></span>
                  {{$item->title}}
              </label>
            @endforeach
          </div>
        </form>
      </div>
      <div class="section__resources">
        <form method="get" action="{{route('resources')}}" id="search-form" class="search__container__form">
          <input type="search" class="search__container__form__input" id="search" name="search" value="{{ old('search') ?? ( isset($search) ? $search : '' ) }}" placeholder="ძიება">
          <svg class="icon">
            <use xlink:href="#ico-search"></use>
          </svg>
        </form>
        <div class="section__resources__container">
          <div class="section__resources__row">
            
            @if(isset($search) && $search != '')
              <h2 class="search__result__title">{{__('site.found')}} (<span class="purple">{{$resources->total()}}</span>) {{__('site.result')}}</h2> 
            @else
              <h2 class="section__resources__title">{{__('site.additional_resources')}}</h2>
            @endif

            <form method="get" action="{{route('resources')}}">
              <select class="custom-select" name="sort" id="sort_select" placeholder="სორტირება">
                <option value="date_asc" @if(isset($sort) && $sort === 'date_asc') selected="selected" @endif>{{__('site.sort_date_desc')}}</option>
                <option value="date_desc" @if(isset($sort) && $sort === 'date_desc') selected="selected" @endif>{{__('site.sort_date_asc')}}</option>
                <option value="char_asc" @if(isset($sort) && $sort === 'char_asc') selected="selected" @endif>{{__('site.sort_alphabet_desc')}}</option>
                <option value="char_desc" @if(isset($sort) && $sort === 'char_desc') selected="selected" @endif>{{__('site.sort_alphabet_asc')}}</option>
              </select>
            </form>            
          </div>
          <div class="document__line"></div>
          <div class="row">
            @foreach ($resources as $resource)
              @include(config('additionaresource.'.$resource->type.'.cardlayout'), [$resource, $search])
            @endforeach
          </div>
          <div class="d-flex justify-content-center">
            {{ $resources->appends(
              [
                'search' => ($search && $search !== '') ? $search : '',
                'direction' => ($direction && $direction !== '') ? $search : '',
                'img' => isset($types->img) ?? '',
                'link' => isset($types->link) ?? '',
                'video' => isset($types->video) ?? '',
                'pdf' => isset($types->pdf) ?? '',
                'topic' => ($topic && $topic !== '') ? $topic : '',
                'sort' => ($sort && $sort !== '') ? $sort : ''
              ]
            )->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
      const filterForm = $('#filter');
      filterForm.on("change", "input:checkbox", function(){

          const val = $('#search').val();
          if(val !== '') {
            appendToForm(val, 'search')
          }

          let sortSelect = $('#sort_select').val();
          if(sortSelect !== '') {
            appendToForm(sortSelect, 'sort')
          }

          filterForm.submit();
      });

      $('#sort_select').on("change", function() {
          let searchVal = $('#search').val();
          if(searchVal !== '') {
            appendToForm(searchVal, 'search')
          }
          appendToForm(this.value, 'sort');
          filterForm.submit();
      })

      $("#search-form").submit( e => {
          e.preventDefault();
          appendToForm($('#search').val(), 'search')
          
          let sortSelect = $('#sort_select').val();
          console.log('sort select', sortSelect)
          if(sortSelect !== '') {
            appendToForm(sortSelect, 'sort')
          }

          filterForm.submit();
      })

      const appendToForm = (val, name) => {
        $("<input>").attr({
            'type':'hidden',
            'name': name
        }).val(val).appendTo(filterForm);
      }
  });
</script>
@endsection