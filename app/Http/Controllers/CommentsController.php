<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Session;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|min:5|max:2000'
        ]);

        $post = Post::find($post_id);

        $comment = new Comment;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('success', 'Comment added');

        return redirect()->route('blog.single', [$post->slug]);
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->with('comment', $comment);
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
        $comment = Comment::find($id);

        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'Comment updated');

        return redirect()->route('posts.show', $comment->post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $comment = Comment::find($id);

        return view('comments.delete')->withComment($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;

        $comment->delete();

        Session::flash('success', 'Comment deleted');

        return redirect()->route('posts.show', $post_id);
    }
}