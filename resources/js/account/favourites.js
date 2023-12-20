const favourites = document.querySelector('#favourites');

let submitting = false;

document.addEventListener('DOMContentLoaded', function() {
    getFavourites();
});

function getFavourites() {

    axios({
        method: 'get',
        url: favouritesUrl,
    })
        .then(function (response) {
            if (response.data.data.length === 0) {
                favourites.innerHTML = `
                    <div class="text-center text-2xl">
                        No listings added to your favourites yet
                    </div>
                `;
            } else {
                favourites.innerHTML = buildFavourites(response.data.data);
                initSliders();
                initFormListeners();
            }

        })
        .catch(function (error) {
        });
}


function initFormListeners() {
    const forms = document.querySelectorAll('form.favourite-action');

    forms.forEach(form => form.addEventListener('submit', (e) => submitForm(e)));
}

function submitForm(e) {
    e.preventDefault();

    const form = e.target;

    const method = form.querySelector('input[name="_method"]').value;

    axios({
        method: method,
        url: form.action,
        data: new FormData(form),
    })
        .then(function (response) {

            Swal.fire({
                title: 'Success',
                text: response.data.message,
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 3000,
                confirmButtonColor: '#fc9f42',
            })

            getFavourites();
            submitting = false;
        })
        .catch(function (error) {
            submitting = false;
        });
}


function buildFavourites(favourites) {

    console.log(favourites);

    let html = ``;

    favourites.forEach(function(bike) {
        html += `
            <div class="p-6 w-full md:w-1/2 lg:w-1/3">
                <div class="relative bg-white rounded-lg border-2 ${bike.uploaded_to_veloeye ? `border-blue-500` : `border-white` } shadow-2xl rounded-2xl">

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

                            ${favouriteForm(bike, favourites)}
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
