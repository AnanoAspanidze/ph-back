<div>
    <div class="about__faq__section page__content__text mb-sm">
        {!!$about->text!!}
    </div>
        
    @if($about->video && $about->illustration)
    <div class="about__video__section mb-md">
        <div class="resource__item__video rd-16">
            <div class="bg-video" style="{{'background-image: url('.asset($about->getUrlPath().'/'.$about->illustration).');'}}">
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
    <div class="about__page__btn__container">
        @if ($about->register_btn)
            <a href="{{route('register')}}" class="about__page__btn bt-blue">{{__('site.register')}}</a>
        @endif
        @if ($about->topic_btn)
            <a href="{{route('topics')}}" class="about__page__btn bt-gray">{{__("site.topics")}}</a>
        @endif
    </div>
    @if (count($about->aboutImgs) > 0)        
        <div class="about__photos__section">
            <h2 class="section__resources__title">ფოტოები</h2>
            <div class="document__line mg-sm"></div>
            <div class="row">
                @foreach ($about->aboutImgs as $aboutImg )                
                <div class="col-12 col-md-6 col-lg-4 col-xxl-3 resource__item__container">
                    <div class="resource__item">
                        <div class="resource__item-relative">
                            <img src="{{asset($aboutImg->getUrlPath().'/'.$aboutImg->illustration)}}" alt="resource image" class="resource__item__img"
                            data-bs-toggle="modal" data-bs-target="#fullscreenImgModal" />
                            <div class="resource__item__icon__position">
                                <div class="resource__item__icon__container">
                                    <div class="resource__item__icon__bg">
                                    <svg class="icon resource__item__icon"><use xlink:href="#icon-image"></use></svg>
                                    </div>
                                    <div class="resource__item__icon__bg">
                                    <a href="{{asset($aboutImg->getUrlPath().'/'.$aboutImg->illustration)}}" download>
                                        <svg class="icon resource__item__icon"><use xlink:href="#icon-feather-download"></use></svg>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="resource__item-link">
                            <h2 class="resource__item__title">{{$aboutImg->file_name}}</h2>
                            <p class="resource__item__description">{{$aboutImg->title}}</p>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>