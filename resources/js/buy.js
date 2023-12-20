const form = document.querySelector('#bike-search-form');
const formInputs = document.querySelectorAll('#bike-search-form input');
const formSelects = document.querySelectorAll('#bike-search-form select');
const listings = document.querySelector('#listings');
const total = document.querySelector('#total');
const clearAllButton = document.querySelector('#clear-all');
const order = document.querySelector('#order');

let submitting = false;

document.addEventListener('DOMContentLoaded', function() {

    form.addEventListener('submit', handleSubmit);

    clearAllButton.addEventListener('click', clearAll);

    getListings();

    formInputs.forEach(formInput => formInput.addEventListener('change', (e) => debouncedSubmit(e)));

    formSelects.forEach(formSelects => formSelects.addEventListener('change', (e) => debouncedSubmit(e)));
});

// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// `wait` milliseconds.
const debounce = (func, wait) => {
    let timeout;

    // This is the function that is returned and will be executed many times
    // We spread (...args) to capture any number of parameters we want to pass
    return function executedFunction(...args) {

        // The callback function to be executed after
        // the debounce time has elapsed
        const later = () => {
            // null timeout to indicate the debounce ended
            timeout = null;

            // Execute the callback
            func(...args);
        };
        // This will reset the waiting every function execution.
        // This is the step that prevents the function from
        // being executed because it will never reach the
        // inside of the previous setTimeout
        clearTimeout(timeout);

        // Restart the debounce waiting period.
        // setTimeout returns a truthy value (it differs in web vs Node)
        timeout = setTimeout(later, wait);
    };
};

function clearAll(e) {
    form.reset();
    handleSubmit(e);
}

function handleSubmit(e) {
    e.preventDefault();
    getListings();
}

function getListings() {

    if (submitting) {
        return false;
    }

    submitting = true;

    listings.innerHTML = `
        <div class="text-center w-full text-2xl my-12">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    `;

    let formData = new FormData(form);

    let params = {};

    formData.forEach(function(value, key) {
        params[key] = value;
    });

    axios({
        method: form.method,
        url: form.action,
        params: params,
    })
        .then(function (response) {
            if (response.data.featured_listings.data.length === 0) {
                listings.innerHTML = `
                    <div class="text-center w-full text-2xl my-12">No results found</div>
                `;

                submitting = false;
            } else {
                listings.innerHTML = buildListings(response.data);
                initSliders();
                initFormListeners();

                total.textContent = `Showing ${response.data.featured_listings.results} of ${response.data.featured_listings.total} results`;

                submitting = false;
            }

        })
        .catch(function (error) {
            submitting = false;
        });
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

function buildListings(data) {

    let html = ``;

    data.featured_listings.data.forEach(function(bike) {
        html += `

            <div class="px-0 py-4 sm:px-4 sm:py-4 md:px-4 md:py-4 lg:px-6 lg:py-6 w-full sm:w-1/2 md:w-1/3 lg:w-1/3">
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

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                            <div>
                                <p class="text-xs font-bold text-gray-400">Condition</p>
                                <p>${bike.condition}</p>
                            </div>

                            ${model(bike)}

                            ${frameSize(bike)}

                            ${distance(bike)}
                        </div>

                        <div class="flex flex-wrap justify-between w-full pt-10">

                            <div class="bg-white rounded mb-4 w-full md:w-auto">
                                <p class="text-xl font-bold pt-2">${bike.price}</p>
                            </div>

                            <a href="${bike.link}" class="orange-btn uppercase rounded-xl text-sm mb-4 w-full md:w-auto">
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

function model(bike) {

    if (bike.model === null) {
        return ``;
    }

    return `
        <div>
            <p class="text-xs font-bold text-gray-400">Model</p>
            <p>${bike.model}</p>
        </div>
    `
}

function frameSize(bike) {
    if (bike.frame_size === null) {
        return ``;
    }

    return `
        <div>
            <p class="text-xs font-bold text-gray-400">Frame Size</p>
            <p>${bike.frame_size}</p>
        </div>
    `
}

function distance(bike) {
    if (bike.distance === null) {
        return ``;
    } else {
        return `
            <div class="col-span-3">
                <p class="text-base font-semibold text-gray-400">
                    <i class="fas fa-map-marker-alt text-black mr-2"></i> ${bike.distance} miles away
                </p>
            </div>
        `
    }
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

const debouncedSubmit = debounce(function(e) {
    handleSubmit(e);
}, 250);
