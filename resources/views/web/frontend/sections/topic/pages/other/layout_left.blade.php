  <section>
    <div class="section__theme__header">
      @include('web.frontend.sections.topic.pages.helper.header', ['topic' => $topic])
    </div>
    <div class="document__line m-0"></div>
      @if($resource->parentStep)
          @include('web.frontend.sections.topic.pages.helper.step', [ 'step' => $resource->parentStep, 'topic' => $topic])
      @endif
    <div class="document__line m-0"></div>
  </section>
  <section class="section__theme__page mb">
    <article>
      <div class="row">
        <div class="col-12 col-lg-6 col-xl-6">
          <h2 class="section__theme__page__subtitle">{{$resource->resourceable->title}}</h2>
          <p class="section__theme__page__subtitle-sm mb">{{$resource->resourceable->sub_title}}</p>
          <div class="page__content__text">
            {!!$resource->resourceable->description!!}
          </div>
          @if ($resource->show_steps)
              @include('web.frontend.sections.topic.pages.helper.steps', [ 'steps' => $steps, 'topic' => $topic])
          @endif
        </div>
        <div class="col-12 col-lg-6 offset-xl-1 col-xl-5">
          @if ($resource->resourceable->type === 'image')
          <div class="section__theme__page__img__container mt-mobile">
            <img src="{{asset($resource->resourceable->getUrlPath().'/'.$resource->resourceable->illustration)}}" alt="image" class="section__theme__page__img">
            @if($resource->resourceable->illustration_title || $resource->resourceable->illustration_desc || $resource->resourceable->illustration_source)
            <div class="section__theme__page__img-hover">
              <h3 class="section__theme__page__img-hover-h3">{{$resource->resourceable->illustration_title}}</h3>
              <p class="section__theme__page__img-hover-p">{{$resource->resourceable->illustration_desc}}</p>
              @if($resource->resourceable->illustration_source)
              <a href="{{$resource->resourceable->illustration_source}}" target="_blank" class="form__section__text-sm-link sm">
                წყარო
                <svg class="icon">
                  <use xlink:href="#feather-arrow-up-right"></use>
                </svg>
              </a>
              @endif
            </div>
            @endif
          </div>
          @else
          <div class="section__theme__page__video__container section__theme__page__img__container mt-mobile margins">
              <iframe width="100%" height="100%"
              src="{{$resource->resourceable->video}}" frameborder="0"
              allowfullscreen="allowfullscreen" class="section__theme__page__video"></iframe>
          </div>
          @endif
        </div>
      </div>
    </article>
    @if ($resource->resources && count($resource->resources) > 0)
      @include('web.frontend.sections.topic.pages.helper.resources', ['resource' => $resource])
    @endif
  </section>