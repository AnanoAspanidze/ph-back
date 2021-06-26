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
                <a href="register.html" class="page__nav__list__item-link">რეგისტრაცია</a>
            </li>
        </ul>
    </section>
    <section class="form__section">
        <div class="row">
            <div class="col-12">
                <h1 class="form__section__title">რეგისტრაცია</h1>
                <p class="form__section__text">ავტორიზაცია შესაძლებელია მხოლოდ განმანათლებლებისთვის</p>
                <form method="POST" action="{{ route('register') }}" class="form form-register">
                @csrf
                    <div class="form-group">
                        <label for="region" class="form__label required @error('region_id') error @enderror">რეგიონი</label>
                        <select class="custom-select @error('region_id') is-invalid @enderror" name="region_id" placeholder="აირჩიეთ რეგიონი">
                            @foreach ($regions as $region)
                                <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="position" class="form__label required @error('position_id') error @enderror">პოზიცია</label>
                        <select class="custom-select @error('position_id') is-invalid @enderror" name="position_id" placeholder="აირჩიეთ პოზიცია">
                            @foreach ($positions as $position )
                                <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach
                            <option value="other" class="select_other">სხვა</option>
                        </select>
                        @error('position_id')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group" id="txtData" style="display:none;">
                        <label for="otherPosition" class="form__label required @error('position_name') error @enderror">სხვა პოზიცია</label>
                        <input type="text" class="form-control form__input @error('position_name') is-invalid @enderror" name="position_name" id="otherPosition">
                        @error('position_name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="workingPlace" class="form__label @error('work_place') error @enderror">სამუშაო ადგილი</label>
                        <input type="text" class="form-control form__input @error('work_place') is-invalid @enderror" name="work_place" value="{{old('work_place')}}" id="workingPlace">

                        @error('work_place')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form__label required">ელ. ფოსტა</label>
                        <input type="email" class="form-control form__input @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="email">

                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name" class="form__label required">სახელი</label>
                        <input type="text" class="form-control form__input @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" id="name">

                        @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="surname" class="form__label required">გვარი</label>
                        <input type="text" class="form-control form__input @error('surname') is-invalid @enderror" name="surname" id="surname">

                        @error('surname')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form__label required">პაროლი</label>
                        <input type="password" class="form-control form__input @error('password') is-invalid @enderror" name="password" id="password">

                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="repeatPassword" class="form__label required">გაიმეორეთ პაროლი</label>
                        <input type="password" class="form-control form__input @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirm">

                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <label class="checkbox-container mt-4">
                        <input type="checkbox" name="termsOfUse">
                        <span class="checkmark"></span>
                        ვეთახმები პლატფორმის <a href="{{route('termsOfUse')}}" class="checkbox-link">მოხმარების პირობებს</a> 
                    </label>

                    @error('termsOfUse')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                    @enderror
                    
                    <label class="checkbox-container mb-34">
                        <input type="checkbox" name="privacy">
                        <span class="checkmark"></span>
                        გავეცანი <a href="{{route('privacy')}}" class="checkbox-link">კონფიდენციალურობის პოლიტიკას</a> 
                    </label>
                    @error('privacy')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                    @enderror

                    <div class="form__row">
                        <button type="submit" class="form__row__btn form__row__btn-login bt-blue w-100">რეგისტრაცია</button>
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
                    <span>უკვე რეგისტრირებული ხართ? </span>
                    <a href="{{route('login')}}" class="form__section__text-sm-link">
                        მიყევით ამ ბმულს
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
