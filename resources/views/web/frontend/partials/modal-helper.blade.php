<a href="{{( $isSubPage ? route('topics.explanation', $resourceItem->id) : route('topics.inner', [$topic->id, $resourceItem->id]) )}}" class="toc-item" data-page-type="{{$basename}}">
    <div class="tableOfConents__item {{$active ? 'active' : ''}}">
        <div class="d-flex align-items-center">
        <img @if($icon) src="{{asset($icon)}}" @else style="display: none;" @endif alt="img" class="tableOfConents__item__img">
            <div>
                <h3 class="tableOfConents__item__title">{{$title}}</h3>
                <p class="tableOfConents__item__text">{{($resourceItem->resourceable ? ( $basename === 'Intro' ? $topic->title : $resourceItem->resourceable[$resourceableItem['title']] ) : $resourceItem->title )}}</p>
            </div>
        </div>
        <div class="tableOfConents__item__number">{{$index}}</div>
    </div>
</a>