const mix = require('laravel-mix');
const resources = "resources/";
const plugins = resources + "plugins/";

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.styles(
    [
        plugins + "fontawesome-free-6/css/all.min.css",
        plugins + "sweetalert2-theme-bootstrap-4/bootstrap-4.min.css",
        plugins + "datatables-bs4/css/dataTables.bootstrap4.min.css",
        plugins + "datatables-responsive/css/responsive.bootstrap4.min.css",
        plugins + "datatables-buttons/css/buttons.bootstrap4.min.css",
        plugins + "select2/css/select2.min.css",
        plugins + "select2-bootstrap4-theme/select2-bootstrap4.min.css",
        plugins + "daterangepicker/daterangepicker.css",
        plugins + "adminlte-3.2.0/dist/css/adminlte.min.css",
        resources + "css/app.css",
    ],
    "public/assets/css/app.css"
).version();

mix.scripts(
    [
        plugins + "jquery/jquery.min.js",
        plugins + "bootstrap/js/bootstrap.bundle.min.js",
        plugins + "jquery-validation/jquery.validate.min.js",
        plugins + "jquery-validation/additional-methods.min.js",
        plugins + "sweetalert2/sweetalert2.min.js",
        plugins + "datatables/jquery.dataTables.min.js",
        plugins + "datatables-bs4/js/dataTables.bootstrap4.min.js",
        plugins + "datatables-responsive/js/dataTables.responsive.min.js",
        plugins + "datatables-responsive/js/responsive.bootstrap4.min.js",
        plugins + "datatables-buttons/js/dataTables.buttons.min.js",
        plugins + "jszip/jszip.min.js",
        plugins + "pdfmake/pdfmake.min.js",
        plugins + "pdfmake/vfs_fonts.js",
        plugins + "datatables-buttons/js/buttons.bootstrap4.min.js",
        plugins + "datatables-buttons/js/buttons.html5.min.js",
        plugins + "datatables-buttons/js/buttons.print.min.js",
        plugins + "select2/js/select2.full.min.js",
        plugins + "chart.js/dist/chart.umd.js",
        plugins + "adminlte-3.2.0/dist/js/adminlte.min.js",
        plugins + "crypto-js/crypto-js.min.js",
        plugins + "bs-custom-file-input/bs-custom-file-input.min.js",
        plugins + "moment/moment.min.js",
        plugins + "daterangepicker/daterangepicker.js",
        resources + "js/secure.js",
        resources + "js/app.js",
        plugins + "lazy-control/postform.js",
        plugins + "lazy-control/buttonaction.js",
    ],
    "public/assets/js/app.js"
).version();

mix.copy(plugins + "adminlte-3.2.0/dist/css/adminlte.min.css.map", "public/assets/css/adminlte.min.css.map");
mix.copy(plugins + "moment/moment.min.js.map", "public/assets/js/moment.min.js.map");
