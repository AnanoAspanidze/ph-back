<div class="col-12 col-md-6 col-lg-4 col-xxl-3 resource__item__container">
    <div class="resource__item">
        <div class="resource__item-relative">
            <div class="resource__item__video">
                <div class="video-container paddings">
                    <iframe width="100%" height="100%"
                    src="{{$resource->link}}" frameborder="0"
                    allowfullscreen="allowfullscreen"></iframe>
                </div>
            </div>
            <div class="resource__item__icon__position">
                <div class="resource__item__icon__container">
                    <div class="resource__item__icon__bg">
                    <img src="{{asset('img/icons/awesome-play-circle.svg')}}" alt="icon" class="resource__item__icon">
                    </div>
                </div>
            </div>
        </div>
        <a href="{{$resource->link}}" target="_blank" class="resource__item-link">
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