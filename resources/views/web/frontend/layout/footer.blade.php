<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="https://www.ph-int.org/" target="_blank">
                    <img src="{{asset('img/phinternational.svg')}}" alt="ph-international" class="footer__top__img">
                </a>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="row">
                <div class="col-12 col-lg-5 d-flex align-items-end align-items-lg-start align-items-xxl-end">
                    <p class="footer__text">
                        {{__('site.footer_text')}}
                    </p>
                </div>
                <div class="footer__contact center mobile-block">
                    <a href="mailto:{{__('site.project_email')}}" class="footer__link footer__item">{{__('site.project_email')}}</a>
                <div class="footer__line footer__item"></div>
                <a href="{{__('site.fb_url')}}" class="footer__item footer__contact__icon">
                    <svg class="icon">
                        <use xlink:href="#icon-fb"></use>
                    </svg>
                </a>
                <a href="{{__('site.youtube_url')}}" class="footer__item footer__contact__icon">
                    <svg class="icon">
                        <use xlink:href="#youtube"></use>
                    </svg>
                </a>
                </div>
                <div class="col-12 col-lg-7 col-xl-7 col-xxl-6 offset-xxl-1 d-flex align-items-end">
                    <div class="footer__contact cont">
                        <div class="footer__contact left">
                            <div class="footer__item-flex">
                                <a href="{{route('termsOfUse')}}" class="footer__item footer__text black">
                                    {{__('site.terms')}}
                                </a>
                                <div class="footer__line first footer__item"></div>
                            </div>
                            <div class="footer__item-flex">
                                <a href="{{route('privacy')}}" class="footer__item footer__text black">
                                    {{__('site.privacy_policy')}}
                                </a>
                                <div class="footer__line second footer__item"></div>
                            </div>
                            <div class="footer__item-flex">
                                <p class="footer__item footer__text black mobile-block hover-black">{{ '© '.now()->year.' '.__('site.all_rights_reserved')}}</p>
                            </div>
                        </div>
                        <div class="footer__contact-right">
                            <div class="footer__contact center mobile-none">
                                <a href="mailto:{{__('site.project_email')}}" class="footer__link footer__item">{{__('site.project_email')}}</a>
                            <div class="footer__line footer__item"></div>
                            <a href="{{__('site.fb_url')}}" class="footer__item footer__contact__icon">
                                <svg class="icon">
                                    <use xlink:href="#icon-fb"></use>
                                </svg>
                            </a>
                            <a href="{{__('site.youtube_url')}}" class="footer__item footer__contact__icon">
                                <svg class="icon">
                                    <use xlink:href="#youtube"></use>
                                </svg>
                            </a>
                            </div>
                            <p class="footer__item footer__text black mobile-none hover-black">{{ '© '.now()->year.' '.__('site.all_rights_reserved')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>