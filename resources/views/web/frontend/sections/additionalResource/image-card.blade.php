<div class="col-12 col-md-6 col-lg-4 col-xxl-3 resource__item__container">
    <div class="resource__item">
        <div class="resource__item-relative">
            <img src="{{asset($resource->getUrlPath().'/images/medium_'.$resource->image)}}" alt="resource image" class="resource__item__img"
            data-bs-toggle="modal" data-bs-target="#fullscreenImgModal" />
            <div class="resource__item__icon__position">
                <div class="resource__item__icon__container">
                    <div class="resource__item__icon__bg">
                        <img src="{{asset('img/icons/image.svg')}}" alt="icon" class="resource__item__icon">
                    </div>
                    <div class="resource__item__icon__bg">
                        <a href="{{asset($resource->getUrlPath().'/images/'.$resource->image)}}" download>
                            <img src="{{asset('img/icons/feather-download.svg')}}" alt="icon" class="resource__item__icon">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="resource__item-link">
            <h2 class="resource__item__title">{!!\Illuminate\Support\Str::highlightSearch($resource->title, $search)!!}</h2>
            <p class="resource__item__description">{{$resource->description}}</p>
        </a>
        @if($resource->source)
        <a href="{{$resource->source}}" target="_blank" class="form__section__text-sm-link sm resource__item-link">
            {{__('site.source')}}
            <svg class="icon">
                <use xlink:href="#feather-arrow-up-right"></use>
            </svg>
        </a>
        @endif
    </div>
</div>