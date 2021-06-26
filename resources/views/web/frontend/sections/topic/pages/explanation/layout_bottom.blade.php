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
  <section class="section__theme__page">
    <article>
      <div class="row">
        <div class="col-12 m-auto">
          <div class="row section__description__header-align">
            <div class="col-12 col-md-11 m-auto page__content-col">
              <h2 class="section__theme__page__subtitle">{{$explanation->title}}</h2>
              <h3 class="section__theme__page__subtitle-sm">{{$explanation->sub_title}}</h3>
            </div>
            <div class="col-12 col-md-1">
              <a href="{{route('topics.inner', [$topic->id, $explanation->resource_id ])}}" class="game__modal-close dark ml-2" data-bs-dismiss="modal" aria-label="Close">
                <svg class="icon">
                  <use xlink:href="#cancel-icon"></use>
                </svg>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 m-auto">
          @if($explanation->type === 'image')
          <div class="section__theme__page__img__container margins mb-0">
            @include('web.frontend.sections.topic.pages.helper.illustration', [
              'illustration_title' => $explanation->illustration_title,
              'illustration_desc' => $explanation->illustration_desc,
              'illustration_source' => $explanation->illustration_source,
              'path' => asset($explanation->getUrlPath().'/'.$explanation->illustration)
            ])
          </div>
          @else
            <div class="section__theme__page__video__container section__theme__page__img__container mb-mobile margins">
                <iframe width="100%" height="100%"
                src="{{$explanation->video}}" frameborder="0"
                allowfullscreen="allowfullscreen" class="section__theme__page__video"></iframe>
            </div>
          @endif
        </div>
        <div class="col-12 m-auto">
          <div class="section__description mg-sm">
            <div class="section__description__body section__description__content  pd-sm">
              <div class="row">
                <div class="col-12 page__content-col m-auto">
                  <p class="section__theme__page__p about__faq__text-light">
                    {!!$explanation->description!!}
                    <!-- <span class="moreText"> -->
                      <!-- ლორემ იპსუმ რთავდნენ გადაუწყვიტეს დედაკაცები სამკუთხედი ინგლისურად გოჭმა გამოსახულებას
                      დანიშვნის დაესაჯა
                      სწორკუთხა გადამეკიდა გზაასაქცევი. ლუარსაბისა გაეპრანჭება ყვიროდნენ განიკითხავს გადაუწყვიტეს
                      გადამეკიდა
                      პირდაღვრემილია, დანიშვნის გარეუბნებს იტირებდა გასცემ კნიაზობა უცერემონიოდ შეხვდებოდნენ. -->
                    <!-- </span> -->
                  </p>
                  <!-- <button class="readMoreBtn header__nav__btn bt-blue">მაჩვენე მეტი
                    <svg class="icon">
                      <use xlink:href="#arrow-dropdown"></use>
                    </svg>
                  </button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
  </section>
  @if ($explanation->resource->resources && count($explanation->resource->resources) > 0)
    @include('web.frontend.sections.topic.pages.helper.resources', ['resource' => $explanation->resource])
  @endif