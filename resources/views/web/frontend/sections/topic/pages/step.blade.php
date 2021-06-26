<section>
    <div class="section__theme__header">
        <h2 class="section__theme__title mb-0">{{$topic->title}}</h2>
        <div class="section__theme__type__cont mobile-none">
            <img src="{{asset('/img/icons/step.png')}}" alt="img" class="tableOfConents__item__img">
            <div>
                <h3 class="tableOfConents__item__title m-0">{{__("site.page_type_step")}} {{$resource->resourceable->index}}</h3>
            </div>
        </div>
    </div>
    
    <div class="document__line m-0"></div>
    <a href="#" class="section__theme__header__bottom">
        <img src="{{asset('/img/icons/step.png')}}" alt="img" class="tableOfConents__item__img">
        <p class="section__theme__header__bottom-p"><span class="tableOfConents__item__title">ნაბიჯი
                {{$resource->resourceable->index}}:</span>{{$resource->resourceable->title}}</p>
        <div class="section__theme__type__cont desktop-none">
            <img src="{{asset('/img/icons/step.png')}}" alt="img" class="tableOfConents__item__img">
            <div>
                <h3 class="tableOfConents__item__title m-0">ნაბიჯი {{$resource->resourceable->index}}</h3>
            </div>
        </div>
    </a>
    <div class="document__line m-0"></div>
</section>
<section class="section__step">
    <div class="row">
        <div class="section__description__content col-12 col-lg-6 d-flex flex-column justify-content-center">
            <div class="section__step__title">
                <img src="{{asset('/img/icons/step.png')}}" alt="img" class="tableOfConents__item__img">
                <h2 class="section__theme__page__subtitle mb-0">{{$resource->resourceable->title}}</h2>
            </div>
            <h3 class="section__theme__page__subtitle-sm mb">{{$resource->resourceable->sub_title}}</h3>
            <p class="about__faq__text-light mb-0">
                {!!$resource->resourceable->description!!}
            </p>
        </div>
        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center">
            <img src="{{asset($resource->resourceable->getUrlPath().'/'.$resource->resourceable->illustration)}}" alt="img" class="section__step__img">
        </div>
    </div>
</section>