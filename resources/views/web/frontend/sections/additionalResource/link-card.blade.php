<div class="col-12 col-md-6 col-lg-4 col-xxl-3 resource__item__container">
    <div class="resource__item">
        <div class="resource__item-relative">
            @if($resource->image)
                <img src="{{asset($resource->getUrlPath().'/images/'.$resource->image)}}" alt="resource image"
                    class="resource__item__img file active" data-bs-toggle="modal" data-bs-target="#fullscreenImgModal" />
            @else
                <a href="{{$resource->link}}" target="_blank" class="w-100 h-100 d-flex justify-content-center align-items-center">
                    <img src="{{asset('img/icons/feather-arrow-up-right.svg')}}" alt="resource image"
                        class="resource__item__img file" />
                </a>
            @endif

            <div class="resource__item__icon__position">
                <div class="resource__item__icon__container">
                    <a href="{{$resource->link}}" target="_blank">
                        <div class="resource__item__icon__bg">
                            <img src="{{asset('img/icons/feather-arrow-up-right.svg')}}" alt="icon" class="resource__item__icon">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <a href="{{$resource->link}}" target="_blank" class="resource__item-link">
            <h2 class="resource__item__title underline">{!!\Illuminate\Support\Str::highlightSearch($resource->title, $search)!!}</h2>
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