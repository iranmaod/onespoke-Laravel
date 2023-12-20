const contactForm = document.querySelector('form#contact-form');

let submitting = false;

document.addEventListener('DOMContentLoaded', function() {
    contactForm.addEventListener('submit', handleContactForm);
});

function handleContactForm(e) {
    e.preventDefault();

    const form = e.target;

    axios({
        method: form.method,
        url: form.action,
        data: new FormData(form),
    })
        .then(function (response) {

            clearErrors();

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

            Swal.close();

            clearErrors();

            for (const property in error.response.data.errors) {
                let input = document.getElementById(property);

                input.closest('div').querySelector('.error').textContent = error.response.data.errors[property][0];
            }
        });
}

function clearErrors() {
    const errorMessages = document.querySelectorAll('.error');

    for (const errorMessage of errorMessages) {
        errorMessage.textContent = '';
    }
}
