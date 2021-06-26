<section class="section__theme" style="background-color: {{ $resource->resourceable->hex_code ?? '#E5E3F0' }};">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="section__theme__content">
                <h2 class="section__theme__title">{{$topic->title}}</h2>
                <h3 class="section__theme__subtitle">{{$resource->resourceable->sub_title}}</h3>
                <p class="section__theme__text">{!!$resource->resourceable->description!!}</p>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="section__theme__bg">
                <img src="{{asset($resource->resourceable->getUrlPath().'/'.$resource->resourceable->illustration)}}" alt="{{$resource->resourceable->illustration.'-image'}}" class="section__theme__img">
            </div>
        </div>
    </div>
</section>