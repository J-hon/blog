<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 5/16/2019
 * Time: 11:39 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use Illuminate\Support\Facades\Mail;

//use Zend\Diactoros\Request;

class PagesController extends Controller {
    public function getIndex() {
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        return view('Pages.welcome')->with('posts', $posts);
    }

    public function getAbout() {
        $first = 'John';
        $last = 'Curtis';

        $fullName = $first. " " .$last;
        $email = 'jonadify007@gmail.com';
        $data = [];
        $data['email'] = $email;
        $data['fullName'] = $fullName;

        return view('Pages.about');
    }

    public function getContact() {
        return view('Pages.contact');
    }

    public function postContact (Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'subject'   => 'min:3',
            'message'   => 'min:10'
        ]);

        $data = [
            'email'     => $request->email,
            'subject'   => $request->subject,
//            We can't the below 'message' cos Laravel has a variable called message and apparently we don't wanna mess anything up
            'bodyMessage' => $request->message
        ];

        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->from($data['email']);
            $message->to('097acb1ef6-c613a9@inbox.mailtrap.io');
            $message->subject($data['subject']);
        });
    }
}