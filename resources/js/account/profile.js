const form = document.querySelector('#profile-form');
const accountTypeRadios = document.querySelectorAll('input[type="radio"][name="account_type"]');
const personalAccountTypeRadio = document.querySelector('input[type="radio"][name="account_type"][value="1"]');
const businessAccountTypeRadio = document.querySelector('input[type="radio"][name="account_type"][value="2"]');

const profileImageFileInput = document.querySelector('#profile-image');
const bannerImageFileInput = document.querySelector('#banner-image');

let profileFilePond;
let verificationFilePond;

const profilePictureModal = document.getElementById('profile-picture-modal');
const bannerImageModal = document.getElementById('banner-image-modal');

let croppable = false;
let profilePictureCropper;
let bannerImageCropper;

const bioTextarea = document.querySelector('textarea[name="bio"]');
const bioCount = document.querySelector('.bio-count');

document.addEventListener('DOMContentLoaded', function() {

    bioTextarea.addEventListener('input', event => {
        const target = event.currentTarget;
        const maxLength = target.getAttribute('maxlength');
        const currentLength = target.value.length;

        if (currentLength >= maxLength) {
            bioCount.classList.add('text-red-400');
        } else {
            bioCount.classList.remove('text-red-400');
        }

        let text = '';

        text = `${currentLength}/${maxLength} ${currentLength === 1 ? 'character' : 'characters'}`;
        bioCount.textContent = text;

    });

    const event = new Event('input');
    bioTextarea.dispatchEvent(event);

    const profileX = profilePictureModal.querySelector('.x');

    profileX.onclick = function () {
        profilePictureModal.style.display = 'none';
        profilePictureCropper.destroy();
    }

    const bannerImageX = bannerImageModal.querySelector('.x');

    bannerImageX.onclick = function () {
        bannerImageModal.style.display = 'none';
        bannerImageModal.destroy();
    }

    form.addEventListener('submit', handleSubmit);

    profileImageFileInput.addEventListener('change', showProfileImageCropper);
    bannerImageFileInput.addEventListener('change', showBannerImageCropper);

    profilePictureModal.querySelector('form').addEventListener('submit', profileImageFileUpload);
    bannerImageModal.querySelector('form').addEventListener('submit', bannerImageFileUpload);

    accountTypeRadios.forEach(radio => radio.addEventListener('click', (e) => handleAccountType(e)));

    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginImageExifOrientation,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType
    );

    FilePond.setOptions({
        credits: false,
        acceptedFileTypes: ['image/*'],
        storeAsFile: true,
    });

    initVerificationFilePond();
});

function handleAccountType(e) {

    const businessInputs = document.querySelector('.business-inputs');

    if (parseInt(e.currentTarget.value) === 2) {

        Swal.fire({
            text: 'Are you sure you want to switch to a business account?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fc9f42',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                businessInputs.classList.remove('hidden');
            } else {
                businessAccountTypeRadio.checked = false;
                personalAccountTypeRadio.checked = true;
                businessInputs.classList.add('hidden');
            }
        });
    } else {
        businessAccountTypeRadio.checked = false;
        personalAccountTypeRadio.checked = true;
        businessInputs.classList.add('hidden');
    }
}

function initVerificationFilePond() {
    verificationFilePond = FilePond.create(document.querySelector('.filepond'));
}

function showProfileImageCropper(e) {
    e.preventDefault();

    console.log('change');

    profilePictureModal.style.display = 'block';

    const reader = new FileReader();
    const file = e.target.files[0];
    const image = document.querySelector('#profile-image-cropper');

    reader.readAsDataURL(file);

    reader.onload = e => {
        image.src = e.target.result;

        profilePictureCropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            ready: function () {
                croppable = true;
            }
        });
    }
}

function profileImageFileUpload(e) {

    e.preventDefault();

    Swal.fire({
        title: 'Uploading Profile Image',
        html: 'Please wait...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    })

    const form = e.target.closest('form');
    let formData = new FormData(form);

    const canvas = profilePictureCropper.getCroppedCanvas({
        width: 240,
        height: 240,
    });

    canvas.toBlob(function(blob) {
        const url = URL.createObjectURL(blob);
        const reader = new FileReader();

        reader.readAsDataURL(blob);

        reader.onloadend = function () {
            const base64Data = reader.result;

            formData.append('profile_photo', base64Data);

            axios({
                method: form.method,
                url: form.action,
                data: formData,
                headers: { "Content-Type": "multipart/form-data" },
            })
                .then(function (response) {
                    console.log(response);

                    profilePictureModal.style.display = 'none';
                    profilePictureCropper.destroy();

                    form.reset();

                    if (response.data.data.profile_image != null) {
                        document.querySelector('.profile-image').src = response.data.data.profile_image;
                    }

                    Swal.close();

                    Swal.fire({
                        title: 'Success',
                        text: 'Profile image has been updated',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer: 3000,
                        confirmButtonColor: '#fc9f42',
                    })
                })
                .catch(function (error) {
                    console.log(error);

                    Swal.close();
                });

        };
    });
}

function showBannerImageCropper(e) {
    e.preventDefault();

    console.log('change');

    bannerImageModal.style.display = 'block';

    const reader = new FileReader();
    const file = e.target.files[0];
    const image = document.querySelector('#banner-image-cropper');

    reader.readAsDataURL(file);

    reader.onload = e => {
        image.src = e.target.result;

        bannerImageCropper = new Cropper(image, {
            aspectRatio: 16 / 9,
            viewMode: 1,
            ready: function () {
                croppable = true;
            }
        });
    }
}

function bannerImageFileUpload(e) {

    e.preventDefault();

    Swal.fire({
        title: 'Uploading Banner Image',
        html: 'Please wait...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    })

    const form = e.target.closest('form');
    let formData = new FormData(form);

    const canvas = bannerImageCropper.getCroppedCanvas();

    canvas.toBlob(function(blob) {
        const url = URL.createObjectURL(blob);
        const reader = new FileReader();

        reader.readAsDataURL(blob);

        reader.onloadend = function () {
            const base64Data = reader.result;

            formData.append('banner_image', base64Data);

            axios({
                method: form.method,
                url: form.action,
                data: formData,
                headers: { "Content-Type": "multipart/form-data" },
            })
                .then(function (response) {
                    console.log(response);

                    bannerImageModal.style.display = 'none';
                    bannerImageCropper.destroy();

                    form.reset();

                    if (response.data.data.banner_image != null) {
                        document.querySelector('#banner-image-bg').style.backgroundImage = `url(${response.data.data.banner_image})`;
                    }

                    Swal.close();

                    Swal.fire({
                        title: 'Success',
                        text: 'Banner image has been updated',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer: 3000,
                        confirmButtonColor: '#fc9f42',
                    })
                })
                .catch(function (error) {
                    console.log(error);

                    Swal.close();
                });

        };
    });
}

function handleSubmit(e) {

    e.preventDefault();

    let formData = new FormData(form);

    axios({
        method: form.method,
        url: form.action,
        data: formData,
        headers: { "Content-Type": "multipart/form-data" },
    })
        .then(function (response) {
            console.log(response);

            clearErrors();

            // clear images
            verificationFilePond.removeFiles();

            if (response.data.data.profile_image != null) {
                document.querySelector('.profile-image').src = response.data.data.profile_image;
            }

            document.querySelector('.user-name').textContent = response.data.data.name;
            document.querySelector('.user-location').textContent = response.data.data.location;
            document.querySelector('.user-bio').textContent = response.data.data.bio;

            Swal.fire({
                title: 'Success',
                text: 'Profile has been updated',
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 3000,
                confirmButtonColor: '#fc9f42',
            })
        })
        .catch(function (error) {

            console.log(error);

            clearErrors();

            for (const property in error.response.data.errors) {
                let input = document.querySelector(`input[name="${property}"]`);

                if (input === null) {
                    input = document.querySelector(`textarea[name="${property}"]`);
                }

                console.log(property);

                input.closest('div').querySelector('label').classList.add('text-red-400');
                input.closest('div').querySelector('.error').textContent = error.response.data.errors[property][0];
            }

        });
}

function clearErrors() {
    const labels = form.querySelectorAll('label');

    for (const label of labels) {
        label.classList.remove('text-red-400');
    }

    const errorMessages = document.querySelectorAll('.error');

    for (const errorMessage of errorMessages) {
        errorMessage.textContent = '';
    }
}
