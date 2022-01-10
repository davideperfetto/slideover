const mix = require('laravel-mix');

mix.js('resources/js/slideover.js', 'public/')
    .postCss("resources/css/slideover.css", "public/", [
        require("tailwindcss"),
    ]);
