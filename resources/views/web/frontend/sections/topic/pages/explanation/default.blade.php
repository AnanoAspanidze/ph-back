<section>
    <div class="section__theme__header">
        <h2 class="section__theme__title mb-0">{{$topic->title}}</h2>
        <div class="section__theme__type__cont mobile-none">
            <img src="{{asset('/img/icons/definition.png')}}" alt="img" class="tableOfConents__item__img">
            <div>
                <h3 class="tableOfConents__item__title m-0">{{__("site.page_type_explanation")}}</h3>
            </div>
        </div>
    </div>
    <div class="document__line m-0"></div>
    @if($explanation->resource->parentStep)
        @include('web.frontend.sections.topic.pages.helper.step', [ 'step' => $explanation->resource->parentStep, 'topic' => $topic])
    @endif
    <div class="document__line m-0"></div>
</section>
<section class="section__description">
    <div class="section__description__header">
      <a href="{{route('topics.inner', [$topic->id, $explanation->resource_id ])}}" class="game__modal-close dark" data-bs-dismiss="modal" aria-label="Close">
        <svg class="icon">
          <use xlink:href="#cancel-icon"></use>
        </svg>
      </a>
    </div>
    <div class="section__description__body section__description__content">
      <div class="row">
        <div class="col-12 page__content-col m-auto">
          <h2 class="section__theme__page__subtitle">{{$explanation->title}}</h2>
          <h3 class="section__theme__page__subtitle-sm">{{$explanation->sub_title}}</h3>
          <p class="section__theme__page__p mt-34 about__faq__text-light">
            {!!$explanation->description!!}
            <!-- <span class="moreText">
            </span> -->
          </p>
          <!-- <button class="readMoreBtn header__nav__btn bt-blue">მაჩვენე მეტი
            <svg class="icon">
              <use xlink:href="#arrow-dropdown"></use>
            </svg>
          </button> -->
        </div>
      </div>
    </div>
</section>
@if ($explanation->resource->resources && count($explanation->resource->resources) > 0)
    @include('web.frontend.sections.topic.pages.helper.resources', ['resource' => $explanation->resource])
@endif