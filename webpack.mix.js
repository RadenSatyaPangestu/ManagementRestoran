const mix = require("laravel-mix");

// Mengompilasi file JavaScript dan CSS
mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .copy(
        "node_modules/bootstrap/dist/css/bootstrap.min.css",
        "public/vendor/bootstrap/css"
    )
    .copy(
        "node_modules/font-awesome/css/font-awesome.min.css",
        "public/vendor/font-awesome/css"
    )
    .copy(
        "node_modules/select2/dist/css/select2.min.css",
        "public/vendor/select2/css"
    )
    .copy(
        "node_modules/daterangepicker/daterangepicker.css",
        "public/vendor/datepicker/css"
    );
