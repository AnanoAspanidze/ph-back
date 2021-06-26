<img src="{{$path}}" alt="image" class="section__theme__page__img">
@if($illustration_title || $illustration_desc || $illustration_source)
<div class="section__theme__page__img-hover">
    <h3 class="section__theme__page__img-hover-h3">{{$illustration_title}}</h3>
    <p class="section__theme__page__img-hover-p">{{$illustration_desc}}</p>
    @if($illustration_source)
    <a href="{{$illustration_source}}" target="_blank" class="form__section__text-sm-link sm">
        წყარო
        <svg class="icon">
            <use xlink:href="#feather-arrow-up-right"></use>
        </svg>
    </a>
    @endif
</div>
@endif