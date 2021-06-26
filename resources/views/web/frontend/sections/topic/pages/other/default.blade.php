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
        <div class="col-12 page__content-col m-auto">
          <h2 class="section__theme__page__subtitle">{{$resource->resourceable->title}}</h2>
          <h3 class="section__theme__page__subtitle-sm mb">{{$resource->resourceable->sub_title}}</h3>
        </div>
        <div class="col-12 page__content-col m-auto">
          <div class="page__content__text">
            {!!$resource->resourceable->description!!}
          </div>
            @if ($resource->show_steps)
                @include('web.frontend.sections.topic.pages.helper.steps', [ 'steps' => $steps, 'topic' => $topic])
            @endif
        </div>
      </div>
    </article>
    @if ($resource->resources && count($resource->resources) > 0)
      @include('web.frontend.sections.topic.pages.helper.resources', ['resource' => $resource])
    @endif
  </section>