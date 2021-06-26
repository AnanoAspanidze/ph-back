@php
    $title = __("site.page_type_discussion");
    $icon = asset('/img/icons/discussion.png');
    if(!$resource->parentStep) {
        $title = __("site.page_type_complex");
        $icon  = asset('/img/icons/complex.png');
    }
@endphp

<h2 class="section__theme__title mb-0">{{$topic->title}}</h2>
<div class="section__theme__type__cont mobile-none">
    <img src="{{$icon}}" alt="img" class="tableOfConents__item__img">
    <div>
        <h3 class="tableOfConents__item__title m-0">{{$title}}</h3>
    </div>
</div>