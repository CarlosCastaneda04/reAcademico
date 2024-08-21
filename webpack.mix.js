const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .postCss('resources/css/navbar.css', 'public/css')
   .postCss('resources/css/materias.css', 'public/css'); // Asegúrate de que esta línea esté aquí
