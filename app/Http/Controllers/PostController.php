<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Storage;
use Image;
use Illuminate\Http\Request;
use App\Category;
use Purifier;
use Session;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //create a variable and store all posts
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        //return a view and pass in the above variable
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'body'          => 'required',
            'featured_image'=> 'sometimes|image|size:1024'
        ));

        //store into the database

        $post = new Post;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        $post->save();

        $post->tags()->sync($request->tags, false);

        //redirect to another page

        Session::flash('success', 'Post saved');
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in the database and save as a variable
        $post = Post::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        //return view and pass in the variable above
        return view('posts.edit')->with('post', $post)->with('categories', $cats)->with('tags', $tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the data
        $post = Post::find($id);

        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug'  => "required|alpha-dash|min:5|max:255|unique:posts,slug,$id",
            'category_id'   => 'required|integer',
            'body'  => 'required',
            'featured_image' => 'image'
        ));

        //save into database
        //no need to run Post::find($id) cos its already being executed above
        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->slug = $request->input('slug');
        $post->body = Purifier::clean($request->input('body'));

        if ($request->hasFile('featured_image')) {

            // add new photo

            $image = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldFileName = $post->image;

            // delete old photo
            Storage::delete($oldFileName);

            // update the database
            $post->image = $filename;
        }


        $post->save();

        $post->tags()->sync($request->tags);

        //set flash data with success message
        Session::flash('success', 'Post updated');

        //redirect to show request
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find id of post
        $post = Post::find($id);
        $post->tags()->detach();
        Storage::delete($post->image);
        $post->delete();

        Session::flash('success', 'Post deleted');
        return redirect()->route('posts.index');
    }
}