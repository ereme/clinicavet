import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// require jQuery normally
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

$(document).ready(function() {
    console.log("hola");
} );