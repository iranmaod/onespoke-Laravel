const activeListings = document.querySelector('#active-listings');
const soldListings = document.querySelector('#sold-listings');

let submitting = false;

document.addEventListener('DOMContentLoaded', function() {
    getListings();
});

function getListings() {

    axios({
        method: 'get',
        url: listingsUrl,
    })
        .then(function (response) {
            activeListings.innerHTML = buildListings(response.data.active_listings.data);
            soldListings.innerHTML = buildListings(response.data.sold_listings.data);
            initDynamicDropdownListeners();
            initFormListeners();
        })
        .catch(function (error) {
        });
}

function openDropdown(event) {
    const element = event.currentTarget;
    const id = event.currentTarget.dataset.id;
    const dropdownId = `dropdown-${id}`;

    const dropdowns = document.querySelectorAll('.dropdown');

    // hide all dropdowns before showing the one that was clicked
    for (let i = 0; i < dropdowns.length; i++) {
        dropdowns[i].classList.add('hidden');
        dropdowns[i].classList.remove('block');
    }

    const popper = createPopper(element, document.getElementById(dropdownId), {
        placement: 'bottom-start'
    });

    document.getElementById(dropdownId).classList.toggle('hidden');
    document.getElementById(dropdownId).classList.toggle('block');
}

function initDynamicDropdownListeners() {

    document.querySelectorAll('.open-popper-dynamic').forEach(element => {
        const id = element.dataset.popper;

        element.addEventListener('click', (e) => openDropdown(e, id));
    })
}

function initFormListeners() {
    const forms = document.querySelectorAll('form.listing-action');

    forms.forEach(form => form.addEventListener('submit', (e) => submitActionForm(e)));
}

function submitActionForm(e) {
    e.preventDefault();

    const form = e.target;

    if (form.action.includes('sold')) {

        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure this bike has been sold?',
            icon: 'warning',
            confirmButtonColor: '#fc9f42',
            showCancelButton: true,
            cancelButtonText: 'No, cancel',
            confirmButtonText: 'Yes, I am sure!',
        }).then((result) => {
            if (result.isConfirmed) {
                submitForm(form);
            } else {
                return;
            }
        })
    } else {
        submitForm(form);
    }
}

function submitForm(form) {

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

            getListings();
            submitting = false;
        })
        .catch(function (error) {
            submitting = false;
        });
}

function buildListings(listings) {

    let html = ``;

    listings.forEach(function(bike) {
        html += `
            <div class="grid md:grid-cols-3 w-2/3 mx-auto py-5 px-2 bg-gray-100 rounded-2xl gap-6 y-listing">

                <div class="img-col relative">
                    <img src="${bike.cover_image}" alt="${bike.title}" class="mx-auto rounded-2xl" />

                    ${listingStatus(bike)}
                </div>

                <div class="col-span-2">

                    <div class="listing-edit flex align-middle justify-between relative">
                        <h2 class="f-arial text-xl text-gray-600">
                            ${bike.title}
                        </h2>

                        <div class="flex space-x-2 px-4">

                            ${bike.sold ? '' : `<a href="${bike.edit_url}" class="pr-5 text-lg">
                                <i class="far fa-edit"></i>
                            </a>`}

                            ${listingDropdown(bike)}
                        </div>

                    </div>

                    <h3 class="blue font-semibold text-lg f-arial">${bike.price}</h3>

                    <div class="grid md:grid-cols-3 gap-4 pt-5 w-full">

                        <div>
                            <p class="text-xs font-semibold">Condition</p>
                            <p>${bike.condition}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold">Model</p>
                            <p>${bike.model}</p>
                        </div>

                         ${frameSize(bike)}
                    </div>

                    <div class="grid md:grid-cols-2 w-full relative mt-16">

                        ${listedOn(bike)}
                        ${lastPausedAt(bike)}
                    </div>

                    ${listingActions(bike)}
                </div>
            </div>
        `;
    });

    return html;

}

function listedOn(bike) {
    if (bike.listed_on === null) {
        return ``;
    }

    return `
        <div class="li-num">
            <p class="text-xs font-semibold">
                <i class="fas fa-calendar text-base pr-3 text-gray-600"></i>
                Listed on ${bike.listed_on}
            </p>
        </div>
    `;
}

function lastPausedAt(bike) {
    if (bike.paused_at === null) {
        return ``;
    }

    return `
        <div class="li-num">
            <p class="text-xs font-semibold">
                <i class="fas fa-calendar text-base pr-3 text-gray-600"></i>
                Last paused at ${bike.paused_at}
            </p>
        </div>
    `;
}

function listingStatus(bike) {

    if (bike.sold) {
        return ``;
    }

    let colour = '';
    let label = '';

    if (bike.published && !bike.paused) {
        colour = 'text-green-500';
        label = 'Active';
    } else if (bike.paused) {
        colour = 'text-red-400';
        label = 'Paused';
    } else {
        colour = 'text-red-500';
        label = 'Inactive';
    }

    return `
        <p class="absolute top-3 left-8 text-black bg-white p-2 rounded-xl">
            <span class="${colour}">
                <i class="fas fa-circle"></i>
            </span> ${label}
        </p>
    `;
}

function listingDropdown(bike) {

    if (bike.sold) {
        return ``;
    }

    return `
        <div class="flex listing-button">
            <div class="">
                <div class="relative inline-flex align-middle">

                    <button data-id="${bike.id}" type="button" class="open-popper-dynamic" data-popper="dropdown-${bike.id}">
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    <div
                        class="hidden popper bg-white border-0 mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg"
                        id="dropdown-${bike.id}"
                    >
                        <div>
                            <div
                                class="bg-white text-gray opacity-75 p-3 mb-0 border border-solid rounded"
                            >
                                ${listingDropdownActions(bike)}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function listingDropdownActions(bike) {
    let html = ``;

    if (!bike.published) {
        html += `
            <form class="listing-action" method="post" action="/api/listings/${bike.id}/publish">
                <input type="hidden" name="_method" value="put">
                <button type="submit" class="text-sm px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:text-yellow-600">
                    Publish
                </button>
            </form>
        `;
    }

    if (bike.published && !bike.paused) {
        html += `
            <form class="listing-action" method="post" action="/api/listings/${bike.id}/pause">
                <input type="hidden" name="_method" value="put">
                <button type="submit" class="text-sm px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:text-yellow-600">
                    Pause
                </button>
            </form>
        `;
    }

    if (bike.paused) {
        html += `
            <form class="listing-action" method="post" action="/api/listings/${bike.id}/unpause">
                <input type="hidden" name="_method" value="put">
                <button type="submit" class="text-sm px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:text-yellow-600">
                    Unpause
                </button>
            </form>
        `;
    }

    if (bike.deleted_at === null) {
        html += `
            <form class="listing-action" method="post" action="/api/listings/${bike.id}">
                <input type="hidden" name="_method" value="delete">
                <button type="submit" class="text-sm px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:text-yellow-600">
                    Delete
                </button>
            </form>
        `;
    }

    return html;
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

function listingActions(bike) {

    if (bike.sold) {
        return ``;
    }

    return `
        <div class="text-right my-5 mr-5">
            <form class="listing-action" method="post" action="/api/listings/${bike.id}/sold">
                <input type="hidden" name="_method" value="put">
                <button type="submit" class="orange-btn rounded-xl uppercase shadow-2xl text-gray-700 font-semibold hover:text-black text-sm yl-button">
                    Has this been been sold?
                </button>
            </form>
        </div>
    `;
}
