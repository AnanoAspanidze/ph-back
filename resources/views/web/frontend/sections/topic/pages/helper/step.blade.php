<a href="{{route('topics.inner', [$topic->id,  $step->id])}}" class="section__theme__header__bottom">
    <img src="{{asset('/img/icons/step.png')}}" alt="img" class="tableOfConents__item__img">
    <p class="section__theme__header__bottom-p"><span class="tableOfConents__item__title">{{__("site.page_type_step")}} {{$step->index}}:</span>{{$step->resourceable->title}}</p>
    <div class="section__theme__type__cont desktop-none">
        <img src="{{asset('/img/icons/complex.png')}}" alt="img" class="tableOfConents__item__img">
        <div>
            <h3 class="tableOfConents__item__title m-0">{{__("site.page_type_complex")}}</h3>
        </div>
    </div>
</a>