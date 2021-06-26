@extends('web.frontend.layout')

@section('title', __("site.topics"))

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
        <a href="{{route('topics')}}" class="page__nav__list__item-link">{{__("site.topics")}}</a>
      </li>
    </ul>
  </section>
  <section class="section__themes">
    <h1 class="section__themes__title">{{__("site.topics")}}</h1>
    <div class="section__themes__search__container">
      <div class="row">
        <div class="col-12 col-lg-6 col-xl-5 col-xxl-4">
          <div class="section__themes__search-relative">
            <h2 class="section__themes__search__title">აირჩიეთ მხარე</h2>
            
            <form id="filter" method="get" action="{{route('topics')}}">
              <div class="section__themes__radiobutton__container">
                  <label class="radiobutton__container">
                    <input type="radio" value="student_resource"  @if($direction && $direction === 'student_resource') checked="checked" @endif name="direction">
                    <span class="checkmark"></span>
                    მოსწავლე
                  </label>
                  <label class="radiobutton__container">
                    <input type="radio" value="teacher_resource" @if($direction && $direction === 'teacher_resource') checked="checked" @endif name="direction">
                    <span class="checkmark"></span>
                    განმანათლებელი
                  </label>
              </div>
            </form>

            <div class="section__themes__search__link__container">
              <a href="{{route('abouts', __('site.additional_info_for_teachers_link'))}}" class="form__section__text-sm-link section__themes__search__link">
                {{__('site.additional_info_for_teachers')}}
                <svg class="icon">
                  <use xlink:href="#feather-arrow-up-right"></use>
                </svg>
              </a>
            </div>
            <div class="section__themes__search__link__container">
              <a href="{{route('abouts', __('site.additional_info_for_students_link'))}}" class="form__section__text-sm-link section__themes__search__link">
                {{__('site.additional_info_for_students')}}
                <svg class="icon">
                  <use xlink:href="#feather-arrow-up-right"></use>
                </svg>
              </a>
            </div>
            <div class="section__themes__search__line"></div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-7">
          <div class="section__themes__search-align-center">
            <form method="get" action="{{route('topics')}}" id="search-form" class="search__container__form">
              <input type="search" class="search__container__form__input" id="search" name="search" value="{{ old('search') ?? ( isset($search) ? $search : '' ) }}" placeholder="ძიება">
              <svg class="icon">
                <use xlink:href="#ico-search"></use>
              </svg>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="row">
        @foreach ($topics as $topic)
          <div class="col-12 col-md-4">
            <a href="{{route('topics.inner', [$topic->id])}}" class="theme__item mb">
              <picture>
                <source srcset="{{asset($topic->getUrlPath().'/medium_'.$topic->illustration)}}" type="image/webp">
                <source srcset="{{asset($topic->getUrlPath().'/medium_'.$topic->illustration)}}" type="image/png">
                <img src="{{asset($topic->getUrlPath().'/medium_'.$topic->illustration)}}" alt="theme image" class="theme__item__img" />
              </picture>
              <h2 class="theme__item__title">{!!\Illuminate\Support\Str::highlightSearch($topic->title, $search)!!}</h2>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
      
      const filterForm = $('#filter');

      $('input[type=radio][name=direction]').on('change', function() {
          const val = $('#search').val();
          if(val !== '') {
            appendToForm(val, 'search')
          }
          filterForm.submit();
      });

      $("#search-form").submit( e => {
          e.preventDefault();
          appendToForm($('#search').val(), 'search')
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