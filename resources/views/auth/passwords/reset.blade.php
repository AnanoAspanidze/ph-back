@extends('web.frontend.layout')

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
                <a class="page__nav__list__item-link">პაროლის შეცვლა</a>
            </li>
        </ul>
    </section>
    <section class="form__section registration__success">
        <div class="row">
            <div class="col-12">
                <h1 class="form__section__title">პაროლის შეცვლა</h1>
                <form class="form" action="{{ route('password.reseting') }}"  method="POST">
                @csrf
                    <input type="hidden" name="token" value="{{$token}}">
                    <input type="hidden" name="email" value="{{$user->email}}">
                    <div class="form-group">
                        <label for="password" class="form__label required">პაროლი</label>
                        <input type="password" class="form-control form__input @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">  
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="repeatPassword" class="form__label required">გაიმეორეთ პაროლი</label>
                        <input type="password" class="form-control form__input @error('password_confirmation') is-invalid @enderror" id="repeatPassword" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form__row">
                        <button type="submit" class="form__row__btn form__row__btn-login bt-blue w-100">დამახსოვრება</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection