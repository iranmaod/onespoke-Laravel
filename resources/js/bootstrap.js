window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    'X-Requested-With': 'XMLHttpRequest'
};

window.axios.defaults.withCredentials = true;

import trix from 'trix';
window.trix = trix;

import * as FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import * as FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import * as FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import * as FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import * as FilePond from 'filepond';

window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginImageExifOrientation = FilePondPluginImageExifOrientation;
window.FilePondPluginFileValidateSize = FilePondPluginFileValidateSize;
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;

window.FilePond = FilePond;

import Fuse from 'fuse.js'
window.Fuse = Fuse;

import Splide from '@splidejs/splide';
window.Splide = Splide;

import Swal from 'sweetalert2'
window.Swal = Swal;

import rangesliderJs from 'rangeslider-js'
window.rangesliderJs = rangesliderJs;

import lightGallery from 'lightgallery'
window.lightGallery = lightGallery;

import Cropper from 'cropperjs'
window.Cropper = Cropper

import { createPopper } from '@popperjs/core';
window.createPopper = createPopper;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
