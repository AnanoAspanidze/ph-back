<section>
    
    <div class="section__theme__header">
        <h2 class="section__theme__title mb-0">{{$topic->title}}</h2>
        <div class="section__theme__type__cont mobile-none">
            <img src="{{asset('img/icons/exercise.png')}}" alt="img" class="tableOfConents__item__img">
            <div>
                <h3 class="tableOfConents__item__title m-0">{{__('site.page_type_game')}}</h3>
            </div>
        </div>
    </div>

    <div class="document__line m-0"></div>
    @if($resource->parentStep)
        @include('web.frontend.sections.topic.pages.helper.step', [ 'step' => $resource->parentStep, 'topic' => $topic])
    @endif
    <div class="document__line m-0"></div>
</section>
<section class="section__exercise">
  <div class="row">
      <div class="col-12 col-lg-3 d-flex flex-column justify-content-end">
        <img src="{{asset('img/illustrations/dog-indicates.gif')}}" alt="dog" class="section__exercise__img mobile-none">
      </div>
      
      <div class="col-12 col-lg-9 page__content-col m-auto m-xl-0">
          <h2 class="section__theme__page__subtitle lg">{{$resource->resourceable->title}}</h2>
          <p class="section__theme__page__subtitle-sm mb">{{$resource->resourceable->sub_title}}</p>
          <p class="about__faq__text-light mb-0">
              {!!$resource->resourceable->instruction!!}
          </p>
          <div class="section__exercise__start-btn__row">
              <a href="#" class="section__theme__type__cont section__exercise__start-btn">
                  <img src="{{asset('img/icons/start.png')}}" alt="img" class="tableOfConents__item__img">
                  <div>
                      <h3 class="tableOfConents__item__title m-0">{{__('site.start')}}</h3>
                  </div>
              </a>
              <img src="{{asset('img/illustrations/dog-indicates.gif')}}" alt="dog" class="section__exercise__img desktop-none">
          </div>
          <div class="document__line mt-0 mt"></div>
      </div>
  </div>
</section>