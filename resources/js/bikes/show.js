const mainFavouriteForm = document.querySelector('form#main-favourite-form');
const modal = document.getElementById('message-user-modal');
const alsoViewed = document.getElementById('also-viewed');

let submitting = false;

document.addEventListener('DOMContentLoaded', function() {

    getAlsoViewed();

    if (window.Laravel.auth.user !== null) {
        mainFavouriteForm.addEventListener('submit', handleFavouriteForm);

        const button = document.getElementById('message-user');

        if (button !== null) {

            button.onclick = function () {
                modal.style.display = 'block';
            }

            const x = document.getElementById('x');

            x.onclick = function () {
                modal.style.display = 'none';
            }

            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }

            const form = modal.querySelector('form');
            form.addEventListener('submit', sendMessage);
        }

    }

    // Create the main slider.
    const primarySlider = new Splide('#primary-slider', {
        type       : 'fade',
        heightRatio: 0.5,
        pagination : false,
        arrows     : false,
        cover      : false,
    });

    if (document.querySelector('#secondary-slider') !== null) {

        // Create and mount the thumbnails slider.
        const secondarySlider = new Splide('#secondary-slider', {
            width       : '100%',
            fixedWidth  : '130px',
            trimSpace   : 'move',
            rewind      : true,
            fixedHeight : 64,
            isNavigation: true,
            gap         : 10,
            focus       : 'center',
            pagination  : false,
            cover       : true,
            breakpoints : {
                '600': {
                    fixedWidth  : 66,
                    fixedHeight : 40,
                }
            }
        }).mount();

        // Set the thumbnails slider as a sync target and then call mount.
        primarySlider.sync(secondarySlider).mount();
    } else {
        primarySlider.mount();
    }

    initLightbox();
});

function initLightbox() {

    const $dynamicGallery = document.getElementById('dynamic-gallery');

    const dynamicGallery = lightGallery(document.querySelector('body'), {
        dynamic: true,
        dynamicEl: images,
        download: false,
        licenseKey: '0000-0000-000-0000',
        container: document.body,
    });

    document.querySelectorAll('#primary-slider .splide__list li.splide__slide').forEach((el, index) => {
        el.addEventListener('click', () => {
            dynamicGallery.openGallery(index);
        });
    });
}

function handleFavouriteForm(e) {
    e.preventDefault();

    const form = e.target;
    const heart = form.querySelector('i.heart');
    const id = form.dataset.id;

    // method is post for favouriting and delete for unfavouriting
    let method = form.method;

    const methodInput = form.querySelector('input[name="_method"]');

    if (methodInput !== null) {
        method = methodInput.value;
    }

    axios({
        method: method,
        url: form.action,
        data: new FormData(form),
    })
        .then(function (response) {

            // update form action
            if (method === 'delete') {
                form.action = favouriteAction;
                methodInput.remove();

                heart.classList.add('far');
                heart.classList.remove('fas');
            } else {
                form.action = unfavouriteAction;

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_method';
                input.value = 'delete';
                form.appendChild(input);

                heart.classList.add('fas');
                heart.classList.remove('far');
            }


            // add hidden _method input

            Swal.fire({
                title: 'Success',
                text: response.data.message,
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 3000,
                confirmButtonColor: '#fc9f42',
            })


            submitting = false;
        })
        .catch(function (error) {
            submitting = false;
        });
}

function sendMessage(e) {

    e.preventDefault();

    const form = modal.querySelector('form');
    let formData = new FormData(form);

    axios({
        method: form.method,
        url: form.action,
        data: formData,
        headers: { "Content-Type": "multipart/form-data" },
    })
        .then(function (response) {

            modal.style.display = 'none';

            form.reset();
            clearErrors();

            Swal.fire({
                title: 'Success',
                text: response.data.message,
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 3000,
                confirmButtonColor: '#fc9f42',
            })
        })
        .catch(function (error) {

            clearErrors();

            for (const property in error.response.data.errors) {
                const input = document.getElementById(property);

                input.closest('div').querySelector('label').classList.add('text-red-400');
                input.closest('div').querySelector('.error').textContent = error.response.data.errors[property][0];
            }

        });
}

function clearErrors() {
    const form = modal.querySelector('form');
    const labels = form.querySelectorAll('label');

    for (const label of labels) {
        label.classList.remove('text-red-400');
    }

    const errorMessages = document.querySelectorAll('.error');

    for (const errorMessage of errorMessages) {
        errorMessage.textContent = '';
    }
}

function getAlsoViewed() {

    axios({
        method: 'get',
        url: alsoViewedUrl,
    })
        .then(function (response) {
            if (response.data.also_viewed.data.length === 0) {
                alsoViewed.closest('section').classList.add('hidden');
            } else {
                alsoViewed.innerHTML = buildAlsoViewed(response.data);
                initSliders();
                initAlsoViewedListeners();
            }

        })
        .catch(function (error) {
        });
}

function initAlsoViewedListeners() {
    if (window.Laravel.auth.user !== null) {

        const forms = alsoViewed.querySelectorAll('form.favourite-action');

        forms.forEach(form => form.addEventListener('submit', (e) => handleFavouriteForm(e)));
    }
}

function buildAlsoViewed(data) {

    let html = ``;

    data.also_viewed.data.forEach(function(bike) {
        html += `

            <div class="p-6 w-full md:w-1/2 lg:w-1/3">
                <div class="relative bg-white border-2 ${bike.uploaded_to_veloeye ? `border-blue-500` : `border-white` } shadow-2xl rounded-2xl">

                    ${veloeye(bike)}

                    <div class="relative">
                        ${slider((bike))}

                        <div class="opacity-0 rounded-tl-2xl rounded-tr-2xl bg-clip-border bg-black bg-no-repeat hover:opacity-70 duration-300 absolute inset-0 z-1 flex justify-center items-center text-base text-white font-semibold text-center p-2">
                            ${bike.description !== null ? bike.truncated_description : bike.title}
                        </div>
                    </div>

                    <div class="p-6 w-full">

                        <div class="w-full flex items-start">
                            <h2 class="w-10/12 text-lg text-gray-900 font-medium title-font mb-4">${bike.title}</h2>

                            ${favouriteForm(bike, data.favourite_listings.data)}
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2 w-full pt-10">

                            <div class="bg-white rounded">
                                <p class="text-xl font-bold pt-2">${bike.price}</p>
                            </div>

                            <a href="${bike.link}" class="orange-btn uppercase rounded-xl text-sm">
                                VIEW DETAILS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `
    });

    return html;

}

function initSliders() {
    document.querySelectorAll('.also-viewed-splide').forEach(carousel => new Splide(carousel, {
        type: 'loop',
        drag: 'free',
        perPage: 1,
        perMove: 1,
        lazyLoad: 'nearby',
    }).mount());

}

function slider(bike) {
    return `
        <div class="also-viewed-splide splide">
            <div class="splide__track">
                <ul class="splide__list">
                    ${bike.images.map(function (image) {
                        return `
                            <li class="splide__slide p-0 rounded-md rounded-tl-2xl rounded-tr-2xl bg-clip-border">
                                <img class="rounded-tl-2xl rounded-tr-2xl bg-clip-border h-48 w-full object-cover object-center" src="${image.url}" alt="${bike.title}">
                            </li>
                        `
                    }).join('')}
                </ul>
            </div>
        </div>
    `;
}

function veloeye(bike) {

    if (!bike.uploaded_to_veloeye) {
        return '';
    }

    return `
         <span class="bg-blue-300 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-xl rounded-br-none rounded-bl-none rounded-tl-none bg-clip-border z-40">
            On veloeye
        </span>
    `;
}

function favouriteForm(bike, favourites) {

    if (window.Laravel.auth.user === null) {
        return ``;
    }

    if (window.Laravel.auth.user.id === bike.user_id) {
        return ``;
    }

    const favourited = favourites.some(favourite => favourite.id === bike.id);

    return `
        <form data-id="${bike.id}" class="favourite-action flex justify-end w-2/12" method="post" action="${favourited ? `/api/favourites/${bike.id}` : `/api/favourites/${bike.id}/favourite`}">

            ${favourited ? `<input type="hidden" name="_method" value="delete">` : ``}

            <button type="submit" class="text-xl orange">
                <i class="heart ${favourited ? `fas` : `far`} fa-heart"></i>
            </button>
        </form>
    `;
}
