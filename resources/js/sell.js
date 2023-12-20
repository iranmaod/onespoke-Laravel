const form = document.querySelector('#new-listing-form');
const veloeyeRadios = document.querySelectorAll('input[type="radio"][name="uploaded_to_veloeye"]');
let filepond;

document.addEventListener('DOMContentLoaded', function() {

    form.addEventListener('submit', handleSubmit);

    veloeyeRadios.forEach(radio => radio.addEventListener('click', (e) => handleVeloeye(e)));

    FilePond.setOptions({
        allowMultiple: true,
        credits: false,
        acceptedFileTypes: ['image/*'],
        storeAsFile: true,
    });

    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginImageExifOrientation,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType
    );

    filepond = FilePond.create(
        document.querySelector('.filepond')
    );

    document.addEventListener('FilePond:addfile', (e) => {
        highlightFirstImage();
    });

    document.addEventListener('FilePond:removefile', (e) => {
        highlightFirstImage();
    });

    document.addEventListener('FilePond:updatefiles', (e) => {
        highlightFirstImage();
    });

    document.addEventListener('FilePond:reorderfiles', (e) => {
        highlightFirstImage();
    });
});

function highlightFirstImage() {

    const file = filepond.getFile();
    const firstImage = document.querySelector(`li#filepond--item-${file.id}`);

    // remove highlighting from all filepond images
    const images = document.querySelectorAll('li.filepond--item');
    images.forEach(image => image.classList.remove('highlight'));

    // highlight first image
    firstImage.classList.add('highlight');
}

function handleSubmit(e) {

    e.preventDefault();

    let formData = new FormData(form);

    Swal.fire({
        title: 'Uploading Your Bike',
        html: 'Please wait...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });

    axios({
        method: form.method,
        url: form.action,
        data: formData,
        headers: { "Content-Type": "multipart/form-data" },
    })
        .then(function (response) {
            console.log(response);

            Swal.close();

            Swal.fire({
                title: 'Success',
                text: `Listing has been published successfully`,
                icon: 'success',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            })

            setTimeout(function() {
                console.log(response.data);
                window.location.href = response.data.data.link;
            }, 5000);
        })
        .catch(function (error) {

            Swal.close();

            const labels = document.querySelectorAll('.form-control label');

            for (const label of labels) {
                label.classList.remove('text-red-400');
            }

            const errorMessages = document.querySelectorAll('.error');

            for (const errorMessage of errorMessages) {
                errorMessage.textContent = '';
            }

            let i = 0;
            for (const property in error.response.data.errors) {
                const input = document.getElementById(property);

                // scroll to first error
                if (i === 0) {

                    setTimeout(function() {
                        window.scrollTo({
                            top: input.offsetTop - 50,
                            behavior: 'smooth'
                        });
                    }, 500);
                }

                console.log(property);

                input.closest('.form-control').querySelector('label').classList.add('text-red-400');
                input.closest('.form-control').querySelector('.error').textContent = error.response.data.errors[property][0];

                i++;
            }
        });
}

function handleVeloeye(e) {

    const input = document.querySelector('input[name="frame_number"]');
    const container = input.closest('.form-control');
    const required = container.querySelector('.required');

    if (parseInt(e.currentTarget.value) === 1) {
        required.classList.remove('hidden');
    } else {
        required.classList.add('hidden');
    }
}
