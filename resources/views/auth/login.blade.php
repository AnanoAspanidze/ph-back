@extends('web.frontend.layout')

@section('content')
<div class="container">
    <section class="page__nav">
        <ul class="page__nav__list">
            <li class="page__nav__list__item">
                <a href="index.html" class="page__nav__list__item-link">{{__('site.home')}}</a>
            </li>
            <li class="page__nav__list__item">
                <svg class="icon">
                    <use xlink:href="#ico-chevron-right"></use>
                </svg>
            </li>
            <li class="page__nav__list__item">
                <a href="login.html" class="page__nav__list__item-link">ავტორიზაცია</a>
            </li>
        </ul>
    </section>
    <section class="form__section">
        <div class="row">
            <div class="col-12">
                <h1 class="form__section__title">ავტორიზაცია</h1>
                <p class="form__section__text">ავტორიზაცია შესაძლებელია მხოლოდ განმანათლებლებისთვის</p>
                <form method="POST" class="form needs-validation" novalidate action="{{ route('login') }}">
                @csrf
                    <div class="form-group">
                        <label for="email" class="form__label @error('email') error @enderror">ელ. ფოსტა</label>
                        <input type="email" class="form-control form__input  @error('email') is-invalid @enderror" id="email" name="email" required autocomplete="email" autofocus>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form__label  @error('password') error @enderror">პაროლი</label>
                        <div class="form__input-relative">
                            <input type="password" class="form-control form__input  @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                            <svg class="icon" id="togglePassword">
                                <use xlink:href="#feather-eye"></use>
                            </svg>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form__row">
                        @if (Route::has('password.request'))
                        <div class="form__row__link__cont">
                            <a href="{{ route('password.request') }}" class="form__row__link">პაროლის აღდგენა</a>
                        </div>
                        @endif
                        <button type="submit" class="form__row__btn form__row__btn-login mobile bt-blue">შესვლა</button>
                    </div>
                    <p class="form__error__message">გთხოვთ შეავსოთ ყველა ველი</p>
                </form>
                <div class="form__section__text__line">
                    <span>ან</span>
                </div>
                <!-- <div class="form__section__btn-cont">
                    <a href="#" class="form__section__btn-social fb">
                        <svg class="icon">
                            <use xlink:href="#icon-fb"></use>
                        </svg>
                        ავტორიზაცია Facebook-ით</a>
                    <a href="#" class="form__section__btn-social google">
                        <svg class="icon">
                            <use xlink:href="#icon-google"></use>
                        </svg>
                        ავტორიზაცია Gmail-ით</a>
                </div> -->
                <div class="form__section__text-sm">
                    <span>გსურთ რეგისტრაცია? მიყევით </span>
                    <a href="{{route('register')}}" class="form__section__text-sm-link">
                         ამ ბმულს
                        <svg class="icon">
                            <use xlink:href="#feather-arrow-up-right"></use>
                          </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
