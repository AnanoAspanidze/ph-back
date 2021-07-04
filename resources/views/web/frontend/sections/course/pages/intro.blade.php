<div class="container">
    <div class="course__intro">
        <div class="row">
            <div class="col-12 col-md-6 col-xxl-8">
                <div class="d-flex flex-column justify-content-center h-100">
                    <div class="course__intro__content">
                        <h2>{{$course->topic->title}}</h2>
                        <p>{{$course->short_desc}}</p>
                    </div>
                    <div class="course__intro__line d-none d-md-block"></div>
                    <div class="d-none d-md-flex justify-content-start">
                        <a href="{{route('course.start', $course->id)}}" class="section__one__btn green course__intro__btn">
                            <div class="section__one__btn__icon-bg">
                                <svg class="icon section__one__btn__icon">
                                    <use xlink:href="#computer"></use>
                                </svg>
                            </div>
                            {{__('site.course_start')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xxl-4">
            <div class="course__intro__video__container mt-mobile">
                <iframe class="course__intro__video" width="100%" height="100%"
                src="{{$course->video}}" frameborder="0"
                allowfullscreen="allowfullscreen"></iframe>
            </div>
            </div>
            <div class="col-12">
            <div class="course__intro__line d-block d-md-none"></div>
            <div class="d-md-none">
                <a href="{{route('course.start', $course->id)}}" class="section__one__btn green course__intro__btn">
                <div class="section__one__btn__icon-bg">
                    <svg class="icon section__one__btn__icon">
                    <use xlink:href="#computer"></use>
                    </svg>
                </div>
                {{__('site.course_start')}}
                </a>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="course__intro-bottom">
    <div class="course__intro__header">
        <div class="container">
            <div class="course__intro__header__row">
            <div class="course__intro__header__item">{{__('site.course_registered')}}: <span class="numb">{{$course->course_detail_count}}</span></div>
            <div class="course__intro__header__item">{{__('site.course_viewd')}}: <span class="numb">{{$course->views}}</span></div>
                <div class="course__intro__header__link__list">
                    @foreach ( explode(',', $course->topic->tags) as $tag)
                        <a href="#" class="course__intro__header__link">{{$tag}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="course__intro__list">
            <h2 class="course__intro__list__title">{{__('site.course_silabus')}}</h2>
            @foreach ($course->parts as $key => $part)
                <a href="" class="course__intro__list__item">
                    <h3> <span>{{++$key}}.</span> {{__('site.course_part').' - '.$part->title}} </h3>
                    <p>{{$part->short_desc}}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>