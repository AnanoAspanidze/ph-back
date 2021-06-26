<div class="search__container">
    <div class="search__container__content">
        <div class="container">
            <div class="row">
                <div class="col-12 page__content-col m-auto">
                    <div class="search__container__row">
                        <h3 class="search__container__title">ჩაწერეთ საძიებო სიტყვა ან ფრაზა</h3>
                        <div class="search__close">
                            <svg class="icon">
                                <use xlink:href="#close"></use>
                            </svg>
                        </div>
                    </div>
                    <form method="get" action="{{route('search')}}" class="search__container__form">
                        <input type="search" class="search__container__form__input" name="search" placeholder="ძიება">
                        <a href="searchResult.html">
                            <svg class="icon search__icon">
                            <use xlink:href="#ico-search"></use>
                            </svg>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>