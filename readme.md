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
    
    // $title and $post will be availabe in the view
    Route::get('post', function () {
        return view('post', [
            'title' => '1st post!!!',
            'post' => 'hello world'
        ]);
    });

## Including CSS and JS

The css / js files and folders in `resources` are meant to be compiled / bundled, so we ignore these for now and put the css we use directly under `public/app.css` and `app.js` and include them in the html as we would in any static page.

## Storing blog posts as html

In the next step, we store the posts as individual html files in resources/posts and use their name as a slug we append to the URL. The commands `dd` and `ddd` are debug commands built in laravel (dump and die (dd) ...and debug (ddd)).

## Route wildcards

A slug / parameter can be checked by using `->where(paramName, regex)` instead of checking it in the route function that returns a 404 if it doesn't match.

    Route::get('post/{post}', function ($slug) {
        $path = __DIR__ . '/../resources/posts/' . $slug . '.html';
        if (!file_exists($path)) {
            //ddd('file does not exist'); // dump, die and debug
            //abort(404);
            return redirect('/');
        }
        $post = file_get_contents($path);
        return view('post', [
            'post' => $post
        ]);
    })->where('post', '[A-z_\-]+'); // letters, underscores and dashes

Additional predefined `whereX` methods are defined such as `whereAlpha(variableName)`, which is the same as `where('post', '[A-z]+')`.

## Caching