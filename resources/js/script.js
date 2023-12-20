
function toggleNavbar(collapseID) {
    document.getElementById(collapseID).classList.toggle('hidden');
    document.getElementById(collapseID).classList.toggle('flex');
}

document.addEventListener('DOMContentLoaded', function() {

    getUnreadMessageCount();

    document.querySelector('.toggle-navbar').addEventListener('click', (e) => toggleNavbar('example-collapse-navbar'));

    document.querySelectorAll('.open-popper').forEach(element => {
        const id = element.dataset.popper;

        element.addEventListener('click', (e) => openPopper(e, id));
    })

    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }
});

/* Optional Javascript to close the radio button version by clicking it again */
var myRadios = document.getElementsByName('tabs2');
var setCheck;
var x = 0;

for (x = 0; x < myRadios.length; x++) {
    myRadios[x].onclick = function() {
        if (setCheck != this) {
            setCheck = this;
        } else {
            this.checked = false;
            setCheck = null;
        }
    };
}

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    const slides = document.getElementsByClassName("mySlides");
    const dots = document.getElementsByClassName("dot");

    if (slides.length === 0) {
        return false;
    }

    if (n > slides.length) {
        slideIndex = 1
    }

    if (n < 1) {
        slideIndex = slides.length
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}

function changeAtiveTab(event, tabID) {
    let element = event.target;

    while(element.nodeName !== "A") {
        element = element.parentNode;
    }

    ulElement = element.parentNode.parentNode;
    aElements = ulElement.querySelectorAll("li > a");
    tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");

    for (let i = 0 ; i < aElements.length; i++) {
        aElements[i].classList.remove("text-black");
        aElements[i].classList.remove("bg-white");
        aElements[i].classList.add("text-yellow-500");
        aElements[i].classList.add("bg-white");
        tabContents[i].classList.add("hidden");
        tabContents[i].classList.remove("block");
    }

    element.classList.remove("text-yellow-500");
    element.classList.remove("bg-white");
    element.classList.add("text-black");

    element.classList.add("bg-white");
    document.getElementById(tabID).classList.remove("hidden");
    document.getElementById(tabID).classList.add("block");
}

// Initialize Swiper
var categorySwiper = new Swiper('.category-swiper', {
    loop: true,
    slidesPerView: 5,
    spaceBetween: 10,
    freeMode: {
        enabled: true,
        minimumVelocity: 0.2,
        momentum: false,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        1440: {
            slidesPerView: 5
        },
        1024: {
            slidesPerView: 5
        },
        768: {
            slidesPerView: 4
        },
        480: {
            slidesPerView: 3
        },
        320: {
            slidesPerView: 2
        },
        0: {
            slidesPerView: 1
        }
    }
});

function openPopper(event, tooltipID) {

    let element = event.target;

    while (element.nodeName !== 'BUTTON') {
        element = element.parentNode;
    }

    const popper = createPopper(
        element,
        document.getElementById(tooltipID),
        {
            placement: 'top',
        }
    );

    document.getElementById(tooltipID).classList.toggle('hidden');
}

function getUnreadMessageCount() {

    if (window.Laravel.auth.user === null) {
        return null;
    }

    axios({
        method: 'get',
        url: '/api/unread-messages',
    })
        .then(function (response) {
            const count = response.data.length;
            const badge = document.querySelector('.unread-message-count')

            badge.textContent = count;

            if (count > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        })
        .catch(function (error) {
        });

}
