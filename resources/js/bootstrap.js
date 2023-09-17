window.$ = require('jquery');

require('bootstrap');

// window.Vue = require('vue');

window.axios = require('axios');

window.toastr = require('toastr/toastr')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.locale = document.documentElement.lang

require('slick-carousel')

require('jquery-ui-dist/jquery-ui')
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
