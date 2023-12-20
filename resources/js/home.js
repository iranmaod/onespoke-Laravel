const featured = document.querySelector('#featured');

let submitting = false;

document.addEventListener('DOMContentLoaded', function() {
    getFeatured();

    rangesliderJs.create(document.querySelector('#slider'), {
        min: 0,
        max: 500,
        value: 10,
        step: 5,
        // callbacks
        onInit: (value, percent, position) => {setSliderValue(value);},
        onSlideStart: (value, percent, position) => {setSliderValue(value);},
        onSlide: (value, percent, position) => {setSliderValue(value);},
        onSlideEnd: (value, percent, position) => {setSliderValue(value);}
    })
});

function setSliderValue(value) {
    document.querySelector('#slider-value').innerHTML = `${value} miles`;
}

function getFeatured() {

    axios({
        method: 'get',
        url: featuredUrl,
    })
        .then(function (response) {
            if (response.data.featured_listings.data.length === 0) {
                featured.closest('section').classList.add('hidden');
            } else {
                featured.innerHTML = buildFeatured(response.data);
                initSliders();
                initFormListeners();
            }
        })
        .catch(function (error) {
        });
}

function initFormListeners() {
    if (window.Laravel.auth.user !== null) {

        const forms = document.querySelectorAll('form.favourite-action');

        forms.forEach(form => form.addEventListener('submit', (e) => handleFavouriteForm(e)));
    }
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

            const favouriteAction = `/api/favourites/${id}/favourite`;
            const unfavouriteAction = `/api/favourites/${id}`;

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

function buildFeatured(data) {

    let html = ``;

    data.featured_listings.data.forEach(function(bike) {
        html += `

            <div class="px-0 md:px-4 py-4 lg:px-6 lg:py-6 w-full md:w-1/2 lg:w-1/3">
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

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full pt-10">

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
    document.querySelectorAll('.splide').forEach(carousel => new Splide(carousel, {
        type: 'loop',
        drag: 'free',
        perPage: 1,
        perMove: 1,
        lazyLoad: 'nearby',
    }).mount());

}

function slider(bike) {
    return `
        <div class="splide">
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
