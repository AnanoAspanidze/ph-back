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
                <a class="page__nav__list__item-link">პაროლის აღდგენა</a>
            </li>
        </ul>
    </section>
    <section class="form__section registration__success">
        <div class="row">
            <div class="col-12">
                <h1 class="form__section__title">პაროლის აღდგენა</h1>
                <form class="form" method="POST" action="{{ route('password.reset') }}">
                @csrf
                    <div class="form-group">
                        <label for="email" class="form__label">ელ. ფოსტა</label>
                        <input type="email" class="form-control form__input @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus id="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="form__row__btn form__row__btn-login bt-blue w-100">აღდგენა</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection