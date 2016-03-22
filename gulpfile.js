var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
var angularPaths = [
    'angular/angular.js',
    'angular-moment/angular-moment.js',
    'angular-toastr/dist/angular-toastr.tpls.js',
    'angular-animate/angular-animate.js',
    'restangular/dist/restangular.js',
    'ng-file-upload/ng-file-upload.js',
    'angular-ui-router/release/angular-ui-router.js',
    'angular-bootstrap/ui-bootstrap-tpls.js',
    'nouislider/distribute/nouislider.js'
];

var applicationPath = [
    "app/app.config.js",
    "app/app.state.js",
    "shared.js",
    "modules.js"
]


elixir(function(mix) {
    //mixing angular dependencies
    //mix.scripts(angularPaths,'public/js/angular-dependencies.js','resources/assets/bower');
    //combining angular modules
    mix.scripts(['**/*.js'],'public/js/modules.js','public/js/app/modules');
    //combining angular modules
    //mix.scripts(['**/*.js'],'public/js/shared.js','public/js/app/shared');
    //combining angular modules and app configurations
    mix.scripts(applicationPath,'public/js/app.js','public/js/');
    //mix less
    mix.less('app.less','public/css');
});
