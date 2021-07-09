<div class="container">
    <div class="course__intro">
      <div class="row">
        <div class="col-12 col-lg-10">
          <div class="course__intro__content light">
            <h2>{{$course->topic->title}}</h2>
            <a href="#">{{__('site.course_part').' - '.$currentPart->title}}</a>
            <p>{{$currentPart->short_desc}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="course__intro-bottom">
    <div class="course__intro__header">
      <div class="container">
        <div class="course__intro__header__row">
          <div class="course__intro__header__item">{{__('site.course_progress')}}: <span>{{ $course->courseDetail->first()->parts ? count(json_decode($course->courseDetail->first()->parts, true)) : 0 }}</span>/<span>{{count($course->parts)}}</span> {{__('site.course_from_part')}}</div>
          <div class="course__intro__header__item">
            <span class="link">
            {{__('site.additional_resources')}}
          </span>
          <span class="ps-2 close-icon">
            <svg class="icon">
              <use xlink:href="#close"></use>
            </svg>
          </span>
        </div>
        </div>
      </div>
    </div>
    <div class="course__intro-bottom__container">
      <div class="container">
        <div class="row course__content__row">
          <div class="col-12 col-xl-7">
            <div class="course__intro__video__container course__intro__video__container-hide">
              <div id="player" class="course__intro__video"></div>
            </div>
            <script src="https://www.youtube.com/player_api"></script>
            @if($currentPart->questions)
              @php( $question = $currentPart->questions->first() )
              <div class="course__quiz__quest-hide">
                <div class="game__quiz__quest course__quiz__quest">
                  <span class="text">{{$question->title.' ? '}}</span>
                  <div class="game__quiz__quest-div" data-bs-toggle="modal" data-bs-target="#gameQuizQuest"> ? </div>
                </div>
                <div class="game__quiz__answ__cont course__quiz__answ__cont">
                  @foreach ( $question->answers as  $answer )
                    <div class="game__quiz__answ">
                      <div class="game__checkbox"></div>
                      <span class="text">{{$answer->answer}}</span>
                    </div>
                  @endforeach
                </div>
                <button class="about__page__btn game__button bt-blue checkQuiz__tbn">შემოწმება</button>
                <div class="game__button__container course__quiz__button__container">
                  <button class="about__page__btn game__button mr bt-gray" id="startQuiz">ახლიდან დაწყება</button>                
                    <form action="{{route('course.next')}}" method="post">
                        @csrf
                        <input type="hidden" name="part_id" value="{{$currentPart->id}}">
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <button class="about__page__btn game__button bt-blue"> @if($course->parts->last()->id === $currentPart->id) დასრულება @else შემდეგი საკითხი @endif</button>
                    <form>
                </div>
              </div>
            @endif

            <div class="course__intro__line"></div>
            <div class="page__content__text">
                {!!$currentPart->description!!}
            </div>
            <div class="course__intro__line"></div>
            <div class="course__download__btn">
              <a href="#">
                {{__('site.course_download_text')}}
                <svg class="icon">
                  <use xlink:href="#icon-feather-download"></use>
                </svg>
              </a>
            </div>
          </div>
          <div class="col-12 col-xl-5">
            <div class="course__list__btn">
              <h3> {{__('site.course_current_part')}}: <span class="purple"><span></span> {{__('site.course_part').' - '.$currentPart->title}}</span> </h3>
              <svg class="icon">
                <use xlink:href="#arrow-dropdown"></use>
              </svg>
            </div>
            <div class="course__list">
                
                @foreach ($course->parts as $key => $part)
                    <a href="{{route('course.inner', [$course->id, $part->id])}}" class="course__intro__list__item  @if(in_array($part->id, $finishedParts)) passed @endif @if($currentPart->id === $part->id) active @endif">
                        <h3>
                            <span>{{++$key}}.</span> {{__('site.course_part').' - '.$part->title}}
                        </h3>
                        <p>{{$part->short_desc}}</p>
                    </a>
                @endforeach
                
            </div>
            <div class="course__intro__line dark d-none d-xl-block"></div>
          </div>
        </div>
        <!-- <div class="course__content__resources">
          <div class="section__resources__row mt-0">
            <h2 class="section__resources__title">დამატებითი რესურსები</h2>
            <form>
              <select class="custom-select" placeholder="სორტირება">
                <option value="1">თარიღი კლებადი</option>
                <option value="2">თარიღი ზრდადი</option>
                <option value="3">ანბანი კლებადი</option>
                <option value="4">ანბანი ზრდადი</option>
              </select>
            </form>
          </div>
          <div class="document__line mg-sm"></div>
          <div class="row">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <img src="assets/img/resource-img.png" alt="resource image" class="resource__item__img"
                    data-bs-toggle="modal" data-bs-target="#fullscreenImgModal" />
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-image"></use>
                        </svg>
                      </div>
                      <div class="resource__item__icon__bg">
                        <a href="assets/img/resource-img.png" download>
                          <svg class="icon resource__item__icon">
                            <use xlink:href="#icon-feather-download"></use>
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title">სამართლებრივი-კულტურა.jpg</h2>
                  <p class="resource__item__description">ვინ არის სამართალდამცავი</p>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <a href="#" class="w-100 h-100 d-flex justify-content-center align-items-center">
                    <img src="assets/img/icons/file.svg" alt="resource image" class="resource__item__img file" />
                  </a>
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-file"></use>
                        </svg>
                      </div>
                      <div class="resource__item__icon__bg">
                        <a href="assets/img/test.pdf" download>
                          <svg class="icon resource__item__icon">
                            <use xlink:href="#icon-feather-download"></use>
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title">ახალი წიგნი.pdf</h2>
                  <p class="resource__item__description">სამართლებრივი კულტურა</p>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <a href="#" class="w-100 h-100 d-flex justify-content-center align-items-center">
                    <img src="assets/img/icons/feather-arrow-up-right.svg" alt="resource image"
                      class="resource__item__img file" />
                  </a>
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-feather-arrow-up-right"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title underline">მოძრაობის წესები და ქვეითები</h2>
                  <p class="resource__item__description">სამართლებრივი კულტურა</p>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <div class="resource__item__video">
                    <div class="video-container paddings">
                      <iframe width="100%" height="100%"
                        src="https://www.youtube.com/embed/i-80SGWfEjM?rel=0&amp;showinfo=0" frameborder="0"
                        allowfullscreen="allowfullscreen"></iframe>
                    </div>
                  </div>
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-awesome-play-circle"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title">პოლიციელი ჩემი მეგობარია.mov</h2>
                  <p class="resource__item__description">სამართლებრივი კულტურა</p>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <img src="assets/img/resource-img.png" alt="resource image" class="resource__item__img"
                    data-bs-toggle="modal" data-bs-target="#fullscreenImgModal" />
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-image"></use>
                        </svg>
                      </div>
                      <div class="resource__item__icon__bg">
                        <a href="assets/img/resource-img.png" download>
                          <svg class="icon resource__item__icon">
                            <use xlink:href="#icon-feather-download"></use>
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title">სამართლებრივი-კულტურა.jpg</h2>
                  <p class="resource__item__description">ვინ არის სამართალდამცავი</p>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <img src="assets/img/illustrations/illustration1.png" alt="resource image"
                    class="resource__item__img file active" data-bs-toggle="modal"
                    data-bs-target="#fullscreenImgModal" />
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-file"></use>
                        </svg>
                      </div>
                      <div class="resource__item__icon__bg">
                        <a href="assets/img/test.pdf" download>
                          <svg class="icon resource__item__icon">
                            <use xlink:href="#icon-feather-download"></use>
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title">ახალი წიგნი.pdf</h2>
                  <p class="resource__item__description">სამართლებრივი კულტურა</p>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <img src="assets/img/themes/theme1.png" alt="resource image" class="resource__item__img file active"
                    data-bs-toggle="modal" data-bs-target="#fullscreenImgModal" />
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-feather-arrow-up-right"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title underline">მოძრაობის წესები და ქვეითები</h2>
                  <p class="resource__item__description">სამართლებრივი კულტურა</p>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <div class="resource__item__video">
                    <div class="video-container paddings">
                      <iframe width="100%" height="100%"
                        src="https://www.youtube.com/embed/i-80SGWfEjM?rel=0&amp;showinfo=0" frameborder="0"
                        allowfullscreen="allowfullscreen"></iframe>
                    </div>
                  </div>
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-awesome-play-circle"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title">პოლიციელი ჩემი მეგობარია.mov</h2>
                  <p class="resource__item__description">სამართლებრივი კულტურა</p>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 resource__item__container">
              <div class="resource__item">
                <div class="resource__item-relative">
                  <img src="assets/img/resource-img.png" alt="resource image" class="resource__item__img"
                    data-bs-toggle="modal" data-bs-target="#fullscreenImgModal" />
                  <div class="resource__item__icon__position">
                    <div class="resource__item__icon__container">
                      <div class="resource__item__icon__bg">
                        <svg class="icon resource__item__icon">
                          <use xlink:href="#icon-image"></use>
                        </svg>
                      </div>
                      <div class="resource__item__icon__bg">
                        <a href="assets/img/resource-img.png" download>
                          <svg class="icon resource__item__icon">
                            <use xlink:href="#icon-feather-download"></use>
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="resource__item-link">
                  <h2 class="resource__item__title">სამართლებრივი-კულტურა.jpg</h2>
                  <p class="resource__item__description">ვინ არის სამართალდამცავი</p>
                </a>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>

@section('scripts')
<script type="text/javascript">
    $('.game__quiz__answ').click(function () {
        // $('.game__quiz__answ.checked').removeClass('checked');
        $('.game__quiz__answ__cont.answered-suc').removeClass('answered-suc');
        $('.game__quiz__answ__cont.answered-err').removeClass('answered-err');
        $('.game__quiz__answ.success.active').removeClass('active');
        $(this).toggleClass('checked');
        if ($(this).hasClass('checked') && $(this).hasClass('success')) {
            $(this).parents(".game__quiz__answ__cont").addClass("answered-suc");
        } else if ($(this).hasClass('checked') && $(this).hasClass('error')) {
            $(this).parents(".game__quiz__answ__cont").addClass("answered-err");
        }
        if ($(this).hasClass('checked') && $(this).hasClass('error')) {
            $(".game__quiz__answ.success").addClass("active");
        }
        $('.checkQuiz__tbn').addClass('show');
    });

    $('.checkQuiz__tbn').click(function () {
        $(this).removeClass('show');
        $('.course__quiz__button__container').addClass('show');
    });
</script>
@endsection