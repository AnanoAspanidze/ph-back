//fixed header on scroll

var header = document.getElementById("header");
function fixedHeaderFunction() {
    if (window.pageYOffset > 400) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}

window.onscroll = function () { fixedHeaderFunction() };


function clickers() {
    $('.header__nav__item-link').click(function () {
        $('.header__nav__item-link').removeClass('active')
        $(this).addClass('active');
    })
    $('.header__nav__search').click(function () {
        $(this).toggleClass('active');
        $('.search__container').toggleClass('active');
    })
    $('.search__close').click(function () {
        $('.search__container').removeClass('active');
    })
    $('.search__icon').click(function () {
        $('.search__result').addClass('active');
        $('.search__container').addClass('result__active');
    })
    $('.dropdown__item').click(function () {
        $('#txtData').hide();
    })
    $('.select_other').click(function () {
        $('#txtData').show();
    })
    //video player
    $(".resource__item__video").click(function () {
        $('iframe', this)[0].src += "&amp;autoplay=1";
        $(this).addClass('open');
    });
}
clickers();

//full size images
var imgs = document.getElementsByClassName("resource__item__img");
for (var i = 0; i < imgs.length; i++) {
    imgs[i].onclick = function () { imageZoom(this); }
}
function imageZoom(ele) {
    document.getElementById("image-fullscreen").style.background = 'black url(' + ele.src + ') no-repeat fixed center center';
    document.getElementById("image-fullscreen").style.backgroundSize = 'contain';
    console.log(document.getElementById("image-fullscreen").style);
}

// dropdown

const dropdownToggler = () => {
    let toggler = document.querySelectorAll('.dropdown--toggler')
    toggler.forEach((item) => {
        item.addEventListener('click', () => {
            let dropdowns = document.querySelectorAll('.dropdown')
            item.parentElement.classList.toggle('open')
            dropdowns.forEach((elem) => {
                if (
                    item.parentElement.getAttribute('id') ===
                    elem.getAttribute('data-for')
                ) {
                    elem.classList.toggle('open')
                }
            })
        })
    })
}
dropdownToggler()

const selectDropdown = () => {
    let dropdownItems = document.querySelectorAll('.dropdown__item')
    dropdownItems.forEach((item) => {
        item.addEventListener('click', (e) => {
            let items = e.target.parentElement.children
            for (let i = 0; i < items.length; i++) {
                if (items[i].classList.contains('dropdown__item--active')) {
                    items[i].classList.remove('dropdown__item--active')
                }
            }
            let dropdownElems = document.querySelectorAll('.dropdown__elem')
            dropdownElems.forEach((elem) => {
                if (
                    elem.getAttribute('id') ===
                    item.parentElement.parentElement.getAttribute('data-for')
                ) {
                    e.target.classList.add('dropdown__item--active')
                    let selectedInfo = elem.children[0].children[0]
                    selectedInfo.innerHTML = e.target.innerHTML
                    selectedInfo.setAttribute('value', e.target.innerHTML)
                    elem.classList.remove('open')
                    e.target.parentElement.parentElement.classList.remove('open')
                }
            })
        })
    })
}
selectDropdown()

// password show function
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    // this.classList.toggle('fa-eye-slash');
});

// bootstrap forms validation
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated'),
                    $('.form__label').addClass('error'),
                    $('.form__error__message').addClass('active')
            }, false)
        })
})()

//header navigation - active items
$(function () {
    $('.header__nav__list a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
});


//# sourceMappingURL=main.js.map
