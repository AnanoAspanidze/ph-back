@extends('web.frontend.layout')

@section('title', __("site.topics"))

@section('content')
<div class="container">
  <section class="page__nav">
    <ul class="page__nav__list">
      <li class="page__nav__list__item">
        <a href="{{route('home')}}" class="page__nav__list__item-link">{{__('site.home')}}</a>
      </li>
      <li class="page__nav__list__item">
        <svg class="icon">
          <use xlink:href="#ico-chevron-right"></use>
        </svg>
      </li>
      <li class="page__nav__list__item">
        <a href="{{route('topics', ['direction'=>'teacher_resource'])}}" class="page__nav__list__item-link">{{__('site.course_topics')}}</a>
      </li>
      <li class="page__nav__list__item">
        <svg class="icon">
          <use xlink:href="#ico-chevron-right"></use>
        </svg>
      </li>
      <li class="page__nav__list__item">
        <a href="" class="page__nav__list__item-link">{{$course->topic->title}}</a>
      </li>
    </ul>
  </section>
</div>
<section>
    <div class="container">
        <div class="course__intro pd-sm">
            <div class="row">
                <div class="col-12 col-lg-10">
                    <div class="course__intro__content light">
                        <h2>{{$course->topic->title}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="course__intro-bottom">
    <div class="course__intro__header">
      <div class="container">
        <div class="course__intro__header__row">
          <div class="course__intro__header__item">პროგრესი: <span>1</span>/<span>10</span> ნაწილიდან</div>
        </div>
      </div>
    </div>
    <div class="course__intro-bottom__container">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 m-auto">
                    <h2 class="course__quiz__title">სრული ტესტი</h2>
                    <p class="course__quiz__description">სერთიფიკატის ასაღებად გაიარეთ ტესტი</p>
                    <div class="course__quiz__container">
                        <div class="game__quiz__quest">
                        <span class="text">კითხვა რომელიც იწყება აქედან და გრძელდება ტექსტი ჩვეულებრივ ინგლისურს გავს, მისი
                            წაითხვა კი შეუძლებელია ტექსტი ჩვეულებრივ ინგლისურს გავს, მისი წაითხვა კი შეუძლებელია ?</span>
                        <div class="game__quiz__quest-div" data-bs-toggle="modal" data-bs-target="#gameQuizQuest"> ? </div>
                        </div>
                        <div class="game__quiz__answ__cont course__quiz__answ__cont">
                        <div class="game__quiz__answ">
                            <div class="game__checkbox"></div>
                            <span class="text">ცხოვრების ჯანსაღი წესი</span>
                        </div>
                        <div class="game__quiz__answ error">
                            <div class="game__checkbox"></div>
                            <span class="text">მოკლე პასუხი თუ იყო საჭირო</span>
                        </div>
                        <div class="game__quiz__answ success">
                            <div class="game__checkbox"></div>
                            <span class="text"> შედარებით გრძელი პასუხი თუ იყო საჭირო</span>
                        </div>
                        <div class="game__quiz__answ success-border">
                            <div class="game__checkbox"></div>
                            <span class="text">ცხოვრების ჯანსაღი წესი არა ისა კიდე</span>
                        </div>
                        </div>
                    </div>
                    <div class="course__quiz__container">
                        <div class="game__quiz__quest">
                        <span class="text">კითხვა რომელიც იწყება აქედან და გრძელდება ტექსტი ჩვეულებრივ ინგლისურს გავს, მისი
                            წაითხვა კი შეუძლებელია ტექსტი ჩვეულებრივ ინგლისურს გავს, მისი წაითხვა კი შეუძლებელია ?</span>
                        <div class="game__quiz__quest-div" data-bs-toggle="modal" data-bs-target="#gameQuizQuest"> ? </div>
                        </div>
                        <div class="game__quiz__answ__cont course__quiz__answ__cont">
                        <div class="game__quiz__answ">
                            <div class="game__checkbox"></div>
                            <span class="text">ცხოვრების ჯანსაღი წესი</span>
                        </div>
                        <div class="game__quiz__answ error">
                            <div class="game__checkbox"></div>
                            <span class="text">მოკლე პასუხი თუ იყო საჭირო</span>
                        </div>
                        <div class="game__quiz__answ success">
                            <div class="game__checkbox"></div>
                            <span class="text"> შედარებით გრძელი პასუხი თუ იყო საჭირო</span>
                        </div>
                        <div class="game__quiz__answ success-border">
                            <div class="game__checkbox"></div>
                            <span class="text">ცხოვრების ჯანსაღი წესი არა ისა კიდე</span>
                        </div>
                        </div>
                    </div>
                    <div class="course__quiz__container">
                        <div class="game__quiz__quest">
                        <span class="text">კითხვა რომელიც იწყება აქედან და გრძელდება ტექსტი ჩვეულებრივ ინგლისურს გავს, მისი
                            წაითხვა კი შეუძლებელია ტექსტი ჩვეულებრივ ინგლისურს გავს, მისი წაითხვა კი შეუძლებელია ?</span>
                        <div class="game__quiz__quest-div" data-bs-toggle="modal" data-bs-target="#gameQuizQuest"> ? </div>
                        </div>
                        <div class="game__box__body purple">
                        <div class="editable game__box__list__container" contenteditable="true">
                            <ul class="game__box__list"> </ul>
                        </div>
                        <div class="game__box__btn">
                            <span class="plus">+</span>
                            <span>ჩაწერა</span>
                        </div>
                        </div>
                    </div>
                    <div class="course__quiz__container">
                        <div class="game__quiz__quest">
                        <span class="text">კითხვა რომელიც იწყება აქედან და გრძელდება ტექსტი ჩვეულებრივ ინგლისურს გავს, მისი
                            წაითხვა კი შეუძლებელია ტექსტი ჩვეულებრივ ინგლისურს გავს, მისი წაითხვა კი შეუძლებელია ?</span>
                        <div class="game__quiz__quest-div" data-bs-toggle="modal" data-bs-target="#gameQuizQuest"> ? </div>
                        </div>
                        <div class="game__quiz__answ__cont course__quiz__answ__cont">
                        <div class="game__quiz__answ">
                            <div class="game__checkbox"></div>
                            <span class="text">ცხოვრების ჯანსაღი წესი</span>
                        </div>
                        <div class="game__quiz__answ error">
                            <div class="game__checkbox"></div>
                            <span class="text">მოკლე პასუხი თუ იყო საჭირო</span>
                        </div>
                        <div class="game__quiz__answ success">
                            <div class="game__checkbox"></div>
                            <span class="text"> შედარებით გრძელი პასუხი თუ იყო საჭირო</span>
                        </div>
                        <div class="game__quiz__answ success-border">
                            <div class="game__checkbox"></div>
                            <span class="text">ცხოვრების ჯანსაღი წესი არა ისა კიდე</span>
                        </div>
                        </div>
                    </div>
                    <div class="game__button__container justify-content-md-between mt-5">
                        <button class="about__page__btn game__button mr bt-gray">ახლიდან დაწყება</button>
                        <button class="about__page__btn game__button bt-blue" data-bs-toggle="modal" data-bs-target="#fillQuiz">დასრულება</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
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
    });


    $('.game__box__btn').click(function (e) {
        $(this).addClass('hide');
        $(this).parent().addClass('active');
        $(this).prev('.game__box__list__container').addClass('active');
        $(this).prev('.game__box__list__container').children(".game__box__list").append('<li class="game__box__list__item game__box__item__text"></li>');
        e.stopPropagation()
        });
        $(document).on("click", function (e) {
        if ($(e.target).is(".game__box__list__item") === false) {
            $('.game__box__btn').removeClass('hide');
        }
    });
</script>
@endsection