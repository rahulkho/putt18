/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/*
 |--------------------------------------------------------------------------
 |
 | Load the dependencies
 |
 |--------------------------------------------------------------------------
 */
require('typeahead.js');
require('jquery-validation');
require('select2');
require('dropzone');

/*
 |--------------------------------------------------------------------------
 |
 | Custom Features for Oxygen
 |
 |--------------------------------------------------------------------------
 */
$(document).ready(function() {
    // confirmation
    $('.js-confirm').on('submit', function (e) {
        return confirm('Are you sure?');
    });

    // trigger tooltips
    $('.js-tooltip, [data-toggle="tooltip"]').tooltip();

    // collapse sidebar
    $('.js-toggle-right-sidebar').on('click', function () {
        $('#sidebar').toggle('collapsed');
    });
});
