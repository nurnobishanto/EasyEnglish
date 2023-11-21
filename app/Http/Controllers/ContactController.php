<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\Comment;
use Mail;
use SEO;

class ContactController extends Controller
{
    public function Contact(){
        return view('website.contact');
    }
    public function storeContactForm(Request $request)
    {


        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:11|numeric',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();
       Contact::create([
           'type' => $input['type'],
           'name' => $input['name'],
           'email' => $input['email'],
           'phone' => $input['phone'],
           'subject' => $input['subject'],
           'message' => $input['message'],
       ]);
        //  Send mail to admin
//        Mail::send('contactMail', array(
//            'type' => $input['type'],
//            'name' => $input['name'],
//            'email' => $input['email'],
//            'phone' => $input['phone'],
//            'subject' => $input['subject'],
//            'message' => $input['message'],
//        ), function($message) use ($request){
//            $message->from($request->email);
//            $message->to('info@accountingclub.com', 'Accounting Club')->subject($request->get('subject'));
//        });

        return redirect()->back()->with(['success' => 'Contact Form Submit Successfully']);
    }

    public function storeComment(Request $request)
    {
        $input = $request->all();
        Comment::create($input);
        return redirect()->back()->with(['success' => 'Comment Submit Successfully']);
    }
}
