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

Best add an alias `alias sail='bash vendor/bin/sail` to the `.bashrc`.

**Important** To use composer and laravel tools, prefix them with `sail` so the right php version is assumed, e.g. `sail composer require laravel/sanctum`

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

Output can easily be cached:

    $path = __DIR__ . '/../resources/posts/' . $slug . '.html';
    $post = cache()->remember("posts.{$slug}", 5, function () use ($path) {
        return file_get_contents($path);
    });

The first parameter is any unique key, here we're using the extrapolated route (e.g. "post.my-fine-post" will always return the content of the my-dine-post.html file). The second parameter is the duration the result should be cached in seconds, other ways would be e.g. `now()->addMinutes(20)`.

## Use a model and Filesystem class to read a directory

The logic for looking up and loading a post can be put into a model (app/Models). The `cache()` function etc. work there as well.
Laravel also provides various filesystem path functions like `app_path` or `ressource_path` (see usage below);

File app/Models/Post.php:

    namespace App\Models;
    
    class Post
    {
        public static function find($slug) {
    
            if(!file_exists($path=resource_path("posts/${slug}.html"))) {
                // redirect('/'); // the method shouldn't be responsible for redirecting
                throw new ModelNotFoundException();
            }
    
            return cache()->remember("posts.{$slug}", 1, function() use ($path) {
                return file_get_contents($path);
            });
        }
    }

The ModelNotFoundException doesn't indicate that the Post class isn't found but that a record isn't found (it extends `RecordsNotFoundException`, which makes this clearer).

To add a method to get all existing posts, we can use Laravels File facade class (`use Illuminate\Support\Facades\File`). As there are several, make sure to select the right one.

File app/Models/Post.php:

    public static function all() {
        // File::allFiles returns an array of SplFileInfo objects
        return array_map(function ($file) {
            // we could also just use $file->getContents(), but the find method might do something
            // necessary before returning it in the future
            return self::find($file->getFilenameWithoutExtension());
        }, File::allFiles(resource_path('posts')));
    }

## Adding Metadata to posts

File metadata for the posts can be added with the [yaml-front-matter](https://github.com/spatie/yaml-front-matter) package. 

After installing this (`composer require spatie/yaml-front-matter` or `vendor/bin/`sail composer require spatie/yaml-front-matter when using sail) this, we can add metadata that we can read / use to the html files of the individual posts.

File `resources/posts/my-first-post.html`:

    ---
    title: 1st post!1!!
    excerpt: agga gf dsgfdasfga
    date: 2021.12.24
    ---
    
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, amet cumque deserunt esse est excepturi molestiae odit sequi ut veniam....</p>

We can then add properties and a constructor to the `Post` model:

    class Post
    {
        public $title;
        public $excerpt;
        public $date;
        public $body;
        public $slug;
    
        /**
         * @param $title
         * @param $excerpt
         * @param $date
         * @param $body
         */
        public function __construct($title, $excerpt, $date, $body, $slug)
        {
            $this->title = $title;
            $this->excerpt = $excerpt;
            $this->date = $date;
            $this->body = $body;
            $this->slug = $slug;
        }
        // ...

In the `all` in the `Post` model method, we can create and return new Posts. Laravel provides a collection function that provides many methods such as map, each, filter and many more. One of the main advantages is the fluent interface instead of wrapping multiple `array_map`s. 

    public static function all()
    {
        return collect(File::files(resource_path("posts")))
            ->map(function ($file) {
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($yfm) {
                return new Post(
                    $yfm->matter('title'),
                    $yfm->matter('excerpt'),
                    $yfm->matter('date'),
                    $yfm->body(),
                    $yfm->matter('slug'),
                );
            });
    }

In the `find` method we can now use the `all()` method to return a post by its slug. The laravel collection class provides methods such as `firstWhere` here to select the first item in a collection with a property matching a certain value. This could be done with `filter` as well but `firstWhere` is more terse.

    public static function find($slug)
    {
        return cache()->remember("posts.{$slug}", 5, function () use ($slug) {
            return self::all()->firstWhere('slug', $slug);
        });
    }

