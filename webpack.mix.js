const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/dist/js")
    .js("resources/js/ckeditor-classic.js", "public/dist/js")
    .js("resources/js/ckeditor-inline.js", "public/dist/js")
    .js("resources/js/ckeditor-balloon.js", "public/dist/js")
    .js("resources/js/ckeditor-balloon-block.js", "public/dist/js")
    .js("resources/js/ckeditor-document.js", "public/dist/js")
    .js("resources/js/inittime.js", "public/dist/js")
    .js("resources/js/livewire-sortable.js", "public/dist/js")
    .js("resources/js/dayjs.min.js", "public/dist/js")
    .js("resources/js/datePickerInitLivewire.js", "public/dist/js")
    .js("resources/js/jquery.min.js", "public/dist/js")
    .css("public/dist/css/_app.css", "public/dist/css/app.css")
    .css("resources/css/custom/custom.css", "public/dist/css/custom.css")
    .css("resources/css/custom/select2.css", "public/dist/css/select2.css")
    .css("resources/css/custom/select2-custom.css", "public/dist/css/select2-custom.css")
    .css("resources/css/custom/select2-bootstrap.css", "public/dist/css/select2-bootstrap.css")
    .css("resources/css/custom/jquery.timepicker.min.css", "public/dist/css/jquery.timepicker.min.css")
    .options({
        processCssUrls: false,
    })
    .copyDirectory("resources/js/select2", "public/dist/js/select2")
    .copyDirectory("resources/json", "public/dist/json")
    .copyDirectory("resources/fonts", "public/dist/fonts")
    .copyDirectory("resources/images", "public/dist/images")
    .sourceMaps();
