<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // just examples how to allow mass assignment to some / all properties
    //protected $fillable = ['title', 'slug', 'body', 'excerpt'];
    //$guarded = ['id'];
}
