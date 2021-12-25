Laravel 8 from scratch

Notes on the laracasts course of the same name

<!-- START doctoc -->
<!-- END doctoc -->

# 1 Prerequisites and Setup

## Introdution to MVC in Laravel

Request (URL call from brower) 
    -> laravel app is loaded
    -> registered response is loaded from `routes.php`, e.g. `Route::get('/', [PizzaController::class, 'index']);`
    -> Controller delegates SQL queries to eloquent model; Controller is also the place for domain knowledge / business logic 
    -> view is loaded (e.g. `index.blade.php`), receives the data from the controller and displays it

## Initial environment setup

`Laravel Sail` is a docker container and command line app with everything needed for developing in laravel.

Install  [(other ways described here)] (https://laravel.com/docs/8.x/installation) with `curl -s https://laravel.build/example-app | bash` (Linux) in the directory where the project should be located. Docker must be installed for this to work. `example app` can be any name, the `laravel.build` URL just returns a shell script with the name given in the URL that is passed to bash with the above command.

To run the app and access it under localhost:  

    cd example-app
    ./vendor/bin/sail up

[upgrade docker-compose](https://stackoverflow.com/questions/49839028/how-to-upgrade-docker-compose-to-latest-version) if you get an error on `sail up`

On first start, this will take some time.

Another way, if php / DB are installed locally, is using the [laravel installer using composer](https://laravel.com/docs/8.x/installation#installation-via-composer). 

## EXKURS: html/css/tailwind workshop for blog design

CSS frameworks are an abomination

# The basics

## Simple routes

Web routes are defined `routes/web.php`, views under `resources/views`. Routes don't have to use / return a view. Some route examples:

    Route::get('/peer', function () {
        return view('peer'); // view file = resources/views/peer.blade.php
    });

    Route::get('/noview', function () {
        return "hey hey my my"; // returns just that, no view file necessary
    });

    Route::get('/givemesomejson', function () {
        // this array gets automatically converted to JSON
        return ['here' => ['you', 'have', 'some', 'json']];
    });

## Including CSS and JS

The css / js files and folders in `resources` are meant to be compiled / bundled, so we ignore these for now and put the css we use directly under `public/app.css` and `app.js` and include them in the html as we would in any static page.