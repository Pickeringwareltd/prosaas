let mix = require('laravel-mix');
let exec = require('child_process').exec;
let path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/task.js', 'public/js')
    .js('resources/js/search_process.js', 'public/js')
    .js('resources/js/search_client.js', 'public/js')
    .js('resources/js/search_staff.js', 'public/js')
    .js('resources/js/sidebar.js', 'public/js')
    .js('resources/js/charts-custom.js', 'public/js')
    .js('resources/js/charts-home.js', 'public/js')
    .js('resources/js/front.js', 'public/js')
    .js('resources/js/company_modals.js', 'public/js')
    .js('resources/js/create_company_info.js', 'public/js')
    .js('resources/js/profile_modals.js', 'public/js')
    .js('resources/js/data_store.js', 'public/js')
    .js('resources/js/grid_layout.js', 'public/js')
    .js('resources/js/search_items.js', 'public/js')
    .js('resources/js/encryption.js', 'public/js')
    .js('resources/js/companies.js', 'public/js')
    .js('resources/js/google_maps.js', 'public/js')
    .js('resources/js/inner_navbar.js', 'public/js')
    .js('resources/js/contact_links.js', 'public/js')
    .js('resources/js/staff_links.js', 'public/js')
    .js('resources/js/inner_navbar_profiles.js', 'public/js')
    .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
    .sass('resources/sass/app-rtl.scss', 'public/css')
    .sass('resources/sass/task.scss', 'public/css')
    .sass('resources/sass/process.scss', 'public/css')
    .sass('resources/sass/create_process.scss', 'public/css')
    .sass('resources/sass/custom_main.scss', 'public/css')
    .sass('resources/sass/staff.scss', 'public/css')
    .sass('resources/sass/sidebar.scss', 'public/css')
    .sass('resources/sass/style.default.scss', 'public/css')
    .sass('resources/sass/dashboard.scss', 'public/css')
    .sass('resources/sass/company.scss', 'public/css')
    .sass('resources/sass/profile.scss', 'public/css')
    .sass('resources/sass/data_store.scss', 'public/css')
    .sass('resources/sass/errors.scss', 'public/css')
    .sass('resources/sass/custom_nav.scss', 'public/css')
    .sass('resources/sass/companies.scss', 'public/css')
    .sass('resources/sass/company_single.scss', 'public/css')
    .sass('resources/sass/company_locations.scss', 'public/css')
    .sass('resources/sass/files.scss', 'public/css')
    .sass('resources/sass/company_staff.scss', 'public/css')
    .sass('resources/sass/company_contacts.scss', 'public/css')
    .sass('resources/sass/processes.scss', 'public/css')
    .sass('resources/sass/profiles.scss', 'public/css')
    .then(() => {
        exec('node_modules/rtlcss/bin/rtlcss.js public/css/app-rtl.css ./public/css/app-rtl.css');
    })
    .version(['public/css/app-rtl.css'])
    .webpackConfig({
        resolve: {
            modules: [
                path.resolve(__dirname, 'vendor/laravel/spark-aurelius/resources/assets/js'),
                'node_modules'
            ],
            alias: {
                'vue$': mix.inProduction() ? 'vue/dist/vue.min' : 'vue/dist/vue.js'
            }
        }
    });
