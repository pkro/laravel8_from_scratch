<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;


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


    public static function find($slug)
    {
            return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug) {
        $post = static::find($slug);
            if(! $post) {
                throw new ModelNotFoundException();
            }

            return $post;
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all', function () {
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
                })
                ->sortBy('date', SORT_REGULAR, true);
        });
    }
}
