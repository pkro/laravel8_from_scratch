<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;


class Post
{
    public static function find($slug) {

        if(!file_exists($path=resource_path("posts/${slug}.html"))) {
            //redirect('/');
            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.{$slug}", 1, function() use ($path) {
            return file_get_contents($path);
        });
    }

    public static function all() {
        // returns an array of SplFileInfo objects
        return array_map(function ($file) {
            // we could also just use $file->getContents(), but the find method might do something
            // necessary before returning it in the future
            return self::find($file->getFilenameWithoutExtension());
        }, File::allFiles(resource_path('posts')));
    }
}
