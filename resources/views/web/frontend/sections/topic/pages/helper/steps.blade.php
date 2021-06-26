<div class="section__theme__step__row">
    <div class="row">
        @foreach($steps as $step)
        <div class="col-12 col-md-6">
            <div class="section__theme__step">
                <img src="{{asset('/img/icons/step.png')}}" alt="step" class="section__theme__step__img">
                <h4 class="section__theme__step__title">{{__("site.page_type_step")}} {{$step->index}}</h4>
                <p class="section__theme__step__text about__faq__text-light">{{$step->resourceable->title}}</p>
                <a href="{{route('topics.inner', [$topic->id, $step->id])}}" class="section__theme__step__btn bt-blue">
                ნაბიჯის არჩევა
                <svg class="icon">
                    <use xlink:href="#arrow-dropdown"></use>
                </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>