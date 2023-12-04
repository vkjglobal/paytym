import _ from 'lodash';
window._ = _;

import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


// resources/js/bootstrap.js (or any other appropriate file)
import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.PUSHER_APP_KEY,
    cluster: process.env.PUSHER_APP_CLUSTER,
    encrypted: true,
});

Echo.channel('admin-notifications')
    .listen('.AdminNotification', (e) => {
        alert("haloooo");
        // Display the admin notification in the dashboard
        // Example: use a toast notification library like Toastify.js
        Toastify({
            text: e.message,
            duration: 3000, // Adjust duration as needed
            gravity: 'top', // Display at the top of the page
            close: true // Option to close the notification
        }).showToast();
    });

