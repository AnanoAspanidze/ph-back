@extends('web.frontend.layout')

@section('title', __('site.home'))

@section('content')    
<div class="section__main__bg">
  <section class="section__main section__one dark">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center">
          <h2 class="section__main__title mt-xl">{{__('site.slogan_top')}}, <span class="d-block"></span> {{__("site.slogan_bottom")}}</h2>
          <p class="section__main__text">{{__("site.project_description")}}</p>
          <div class="section__one__btn__container mb-xl">
            <a href="{{route('topics', ['direction' => 'student_resource'])}}" class="section__one__btn green">
              <div class="section__one__btn__icon-bg">
                <img src="{{asset('img/icons/computer.svg')}}" alt="ისწავლე" class="section__one__btn__icon">
              </div>
              {{__("site.learn")}}
            </a>
            <a href="{{route('topics', ['direction' => 'teacher_resource'])}}" class="section__one__btn yellow">
              <div class="section__one__btn__icon-bg">
                <img src="{{asset('img/icons/book-open.svg')}}" alt="{{__('site.teach')}}" class="section__one__btn__icon">
              </div>
              {{__("site.teach")}}
            </a>
          </div>
        </div>
        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center">
          <picture>
            <source srcset="{{asset('img/illustrations/illustration1.webp')}}" type="image/webp">
            <source srcset="{{asset('img/illustrations/illustration1.png')}}" type="image/png">
            <img src="{{asset('img/illustrations/illustration1.png')}}" alt="img" class="section__one__img" />
          </picture>
        </div>
      </div>
    </div>
  </section>
  <section class="section__main section__two light">
    <div class="container">
      <div class="row">
        
        <div class="col-12 col-lg-10 col-xl-8 col-xxl-6 m-auto">
          <h2 class="section__main__title mt">{{__('site.about_section_title')}}</h2>
          <p class="section__main__text mt">{{__('site.about_section_description')}}</p>
          <a href="{{route('abouts')}}" class="bt-blue section__two__btn mt">{{__('site.see_more')}}</a>
        </div>

        <div class="col-12 m-auto">
          @if($about)
          <div class="about__video__section margins">
            <div class="resource__item__video rd-16">
              <div class="bg-video" style="{{ 'background-image: url('.asset($about->getUrlPath().'/medium_'.$about->illustration).');'}}">
                <div class="about__video__section__bg"></div>
                <div class="bt-play"></div>
              </div>
              <div class="video-container">
                <iframe width="100%" height="100%" src="{{$about->video}}"
                  frameborder="0" allowfullscreen="allowfullscreen" allow="autoplay"></iframe>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>
  <section class="section__main section__three dark">
    <div class="container">
      <div class="row">
        
       <div class="col-11 m-auto">
          <h2 class="section__main__title mt">{{__("site.topics")}}</h2>
          <p class="section__main__text mt mb">{{__("site.themes_section_description")}}</p>
        </div>

        <div class="col-12 m-auto">
          <div class="row">
            @foreach ($topics as $topic)
                <div class="col-12 col-md-4">
                    <a href="{{route('topics.inner', [$topic->id])}}" class="theme__item mb">
                        <picture>
                        <source srcset="{{asset($topic->getUrlPath().'/medium_'.$topic->illustration)}}" type="image/webp">
                        <source srcset="{{asset($topic->getUrlPath().'/medium_'.$topic->illustration)}}" type="image/png">
                        <img src="{{asset($topic->getUrlPath().'/medium_'.$topic->illustration)}}" alt="theme image" class="theme__item__img" />
                        </picture>
                        <h2 class="theme__item__title mt">{{$topic->title}}</h2>
                    </a>
                </div>
            @endforeach
          </div>
          <a href="{{route('topics')}}" class="bt-blue section__two__btn mb">{{__('site.all_themes')}}</a>
        </div>
      </div>
    </div>
  </section>
  <section class="section__main section__four light">
    <div class="container">
      <div class="row">
        <div class="col-11 m-auto">
          <h2 class="section__main__title mt mb">{{__('site.why_learn_here_section_title')}}</h2>
        </div>
        <div class="col-12  m-auto">
          <div class="row">
            <div class="col-12 col-md-4">
              <a class="section__four__item">
                <picture>
                  <source srcset="{{asset('img/illustrations/illustration7.webp')}}" type="image/webp">
                  <source srcset="{{asset('img/illustrations/illustration7.png')}}" type="image/png">
                  <img src="{{asset('img/illustrations/illustration7.png')}}" alt="theme image"
                    class="section__four__item__img" />
                </picture>
                <h2 class="theme__item__title mb mt">{{__('site.why_learn_here_games_title')}}</h2>
                <p class="section__main__text">{{__('site.why_learn_here_games_description')}}</p>
              </a>
            </div>
            <div class="col-12 col-md-4">
              <a class="section__four__item">
                <picture>
                  <source srcset="{{asset('img/illustrations/illustration8.webp')}}" type="image/webp">
                  <source srcset="{{asset('img/illustrations/illustration8.png')}}" type="image/png">
                  <img src="{{asset('img/illustrations/illustration8.png')}}" alt="theme image"
                    class="section__four__item__img" />
                </picture>
                <h2 class="theme__item__title mb mt">{{__('site.why_learn_here_individual_title')}}</h2>
                <p class="section__main__text">{{__('site.why_learn_here_individual_description')}}</p>
              </a>
            </div>
            <div class="col-12 col-md-4">
              <a class="section__four__item">
                <picture>
                  <source srcset="{{asset('img/illustrations/illustration9.webp')}}" type="image/webp">
                  <source srcset="{{asset('img/illustrations/illustration9.png')}}" type="image/png">
                  <img src="{{asset('img/illustrations/illustration9.png')}}" alt="theme image"
                    class="section__four__item__img" />
                </picture>
                <h2 class="theme__item__title mb mt">{{__('site.why_learn_here_certificate_title')}}</h2>
                <p class="section__main__text">{{__('site.why_learn_here_certificate_description')}}</p>
              </a>
            </div>
          </div>
          <div class="section__four__btn__container">
            <a href="{{route('topics')}}" class="section__one__btn section__four__btn green">
              <div class="section__one__btn__icon-bg">
                <img src="{{asset('img/icons/computer.svg')}}" alt="ისწავლე" class="section__one__btn__icon">
              </div>
              {{__('site.start_learning')}}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section__main section__five dark">
    <div class="container">
      <div class="row">
        
        <div class="col-12 col-md-6 col-lg-5 col-xxl-6  d-flex flex-column justify-content-center">
          <picture>
            <source srcset="{{asset('img/illustrations/illustration2.webp')}}" type="image/webp">
            <source srcset="{{asset('img/illustrations/illustration2.png')}}" type="image/png">
            <img src="{{asset('img/illustrations/illustration2.png')}}" alt="img" class="section__five__img mb-0" />
          </picture>
        </div>
        
        <div class="col-12 col-md-6 col-lg-7 col-xxl-6 d-flex flex-column justify-content-center">
          <div class="section__five__content">
            <h2 class="section__main__title mt-lg">{{__('site.become_teacher_section_title')}}</h2>
            <p class="section__main__text mt-0">{{__('site.become_teacher_section_description')}}</p>
            <a href="{{route('register')}}" class="bt-blue section__two__btn mt mb">{{__('site.join_us')}}</a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="section__main section__six light">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-10 col-xl-8 col-xxl-6 m-auto">
          <h2 class="section__main__title mt">{{__('site.our_supporters_section_title')}}</h2>
          <p class="section__main__text mt">{{__('site.our_supporters_section_description')}}</p>
        </div>
        <div class="col-12 m-auto">
          <div class="section__six__row">
            <div class="section__six__row__item">
              <a href="https://ge.usembassy.gov/" target="_blank">
                <picture>
                  <source srcset="{{asset('img/us-flag.webp')}}" type="image/webp">
                  <source srcset="{{asset('img/us-flag.png')}}" type="image/png">
                  <img src="{{asset('img/us-flag.png')}}" alt="supporter" class="section__six__row__item__img mr" />
                </picture>
                <picture>
                  <source srcset="{{asset('img/Embassy.webp')}}" type="image/webp">
                  <source srcset="{{asset('img/Embassy.png')}}" type="image/png">
                  <img src="{{asset('img/Embassy.png')}}" alt="supporter" class="section__six__row__item__img" />
                </picture>
              </a>
            </div>
            <div class="section__six__row__item">
              <a href="https://www.mes.gov.ge/" target="_blank">
                <picture>
                  <source srcset="{{asset('img/mes-gov.webp')}}" type="image/webp">
                  <source srcset="{{asset('img/mes-gov.png')}}" type="image/png">
                  <img src="{{asset('img/mes-gov.png')}}" alt="supporter" class="section__six__row__item__img" />
                </picture>
              </a>
            </div>
            <div class="section__six__row__item">
              <a href="https://police.ge/" target="_blank">
                <picture>
                  <source srcset="{{asset('img/shss.webp')}}" type="image/webp">
                  <source srcset="{{asset('img/shss.png')}}" type="image/png">
                  <img src="{{asset('img/shss.png')}}" alt="supporter" class="section__six__row__item__img" />
                </picture>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection