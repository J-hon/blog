<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getIndex() {
        $posts = Post::paginate(5);
        return view('blog.index')->with('posts', $posts);
    }

    public function getSingle($slug) {
        // fetch from the database based on the slug
        // get and first work the same way only that first stops at the first match while get picks all matches
        $post = Post::where('slug', '=', $slug)->first();

        // return the view and pass in the object
        return view('blog.single')->with('post', $post);
    }
}
