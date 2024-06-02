<?php

namespace App\Http\Controllers;


use App\Models\ContactMessage;
use App\Models\PrayerRequest;
use App\Models\FAQ;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Quote;
use App\Models\Sermon;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quotes = Quote::orderBy('created_at', 'desc')->get();
        $events = Event::where('status', 1)->orderBy('created_at', 'desc')->get();
        $serms = Sermon::take(2)->latest()->get();

        return view('welcome', compact('quotes', 'events', 'serms'));
    }
    public function Sermons()
    {
        $mainserms = Sermon::orderBy('created_at', 'desc')->get();
        $trendingPosts = Sermon::trending()->get();
        return view('pages.Sermons', compact('mainserms', 'trendingPosts'));
    }


    public function ProjectDetails($slug)
    {

        $eventdetails = Project::where('slug', $slug)->first();
        $events = Project::where('status', 0)->take(3)->inRandomOrder()->get();

        return view('pages.project_details' , compact('eventdetails', 'events'));
    }

    public function Downloads()
    {
        $downloads = Download::where('status', 0)->orderBy('created_at', 'desc')->get();

        return view('pages.downloads', compact('downloads'));
    }
    public function AboutUs()
    {
        $downloads = Gallery::inRandomOrder()->get();
        $quotes = Quote::orderBy('created_at', 'desc')->get();
        $serms = Sermon::take(2)->latest()->get();

        return view('pages.about', compact('downloads', 'quotes', 'serms'));
    }

    public function Live()
    {

        return view('pages.Live');
    }

    public function Give()
    {

        return view('pages.give');
    }

    public function FAQ()
    {
        $faqs = FAQ::orderBy('id', 'desc')->get();
        $faqcount = FAQ::count();

        return view('pages.FAQ' , compact('faqs', 'faqcount'));
    }
    public function whatwedoDetails($slug)
    {

        $eventdetails = WhatWeDo::where('slug', $slug)->first();
        $events = WhatWeDo::take(4)->inRandomOrder()->get();
        $depts = Department::orderBy('name')->get();

        return view('pages.whatwedo_details' , compact('eventdetails', 'events', 'depts'));
    }

    public function eventDetails($slug)
    {

        $eventdetails = Event::where('slug', $slug)->first();
        $events = Event::where('status', 1)->take(2)->get();


        return view('pages.event_details' , compact('eventdetails', 'events'));
    }
    public function Departments()
    {
        $depts = Department::orderBy('name')->get();

        return view('pages.departments', compact('depts'));
    }


    public function ContactUs()
    {

        return view('pages.contact');
    }
    public function Events()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(12);

        return view('pages.events', compact('events'));
    }
    public function Testimonies()
    {
        $volunteers = Testimony::where('publish','yes')->latest()->get();

        return view('pages.testimonies', compact('volunteers'));
    }

    public function PrayerReq()
    {

        return view('pages.PrayerReq');
    }

    public function postMessage(Request $request) {
        $data = array(
            'name'      =>  $request->name,
            'message'   =>  $request->message,
            'phone'     =>  $request->phone,
            'subject'   =>  $request->subject,
            'city'   =>  $request->city,
            'province'   =>  $request->province,
            'email'   =>  $request->email,
            'country'   =>  $request->country,
            'title'   =>  $request->title,
        );

        $validator = Validator::make($data, [
            'name'      =>  'required|string|max:50',
            'phone'     =>  'nullable|string|max:15|min:5',
            'subject'   =>  'required|string|max:50',
            'message'   =>  'required',
            'title'   =>  'required|string',
        ], [
            'name.required'     =>  'Name field is required. Please fill in your name.',
            'phone.nullable'     =>  'Phone field must not exceed 15 digits.',
            'subject.required'   =>  'Subject field Cannot be empty',
            'message.required'  =>  'Your forgot to type a message. Kindly write your message to proceed'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        $message = ContactMessage::create($data);
        Session::flash('success', 'Your message has been received and will be duly treated. We will contact you as soon as possible if need be.');
        // Mail::to('support@aspenafrica.org')->send(new \App\Mail\ContactMessage($message));
        return redirect()->back();
    }



    public function postNewsLetter(Request $request) {

        $data = array(

            'email'   =>  $request->email,
        );

        $validator = Validator::make($data, [
            'email'     =>  'required|email|max:50',
        ], [
            'email.required'    =>  'E-Mail field is required. Please enter your e-mail address.',
            'email.email'       =>  'A valid e-mail is required as this will be our primary mode of contacting you for feedback.',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        $message = Newsletter::create($data);
        Session::flash('success', 'You have successfully subdcribed to our weekly spiritual newsletter.');
        // Mail::to('support@aspenafrica.org')->send(new \App\Mail\ContactMessage($message));
        return redirect()->back();

    }


public function posPrayer(Request $request) {

    $data = array(

        'email'   =>  $request->email,
        'name'   =>  $request->name,
        'phone'   =>  $request->phone,
        'location'   =>  $request->location,
        'prayer_request'   =>  $request->prayer_request,
    );

    $validator = Validator::make($data, [
        'name'      =>  'required|string|max:50',
        'phone'     =>  'required|string|max:15|min:5',
    ], [
        'name.required'     =>  'Name field is required. Please fill in your name.',
        'phone.nullable'     =>  'Phone field must not exceed 15 digits.',
        'phone.required'     =>  'Phone field is required.',
    ]);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }


    $message = PrayerRequest::create($data);
    Session::flash('success', 'Your Prayer Request was sent successfully');
    return redirect()->back();

}

public function posTestimony(Request $request) {
    $data = array(
        'name'      =>  $request->name,
        'message'   =>  $request->message,
        'identity'     =>  $request->identity,
    );

    $validator = Validator::make($data, [
        'name'      =>  'required|string|max:50',
        'message'   =>  'required',
        'identity'   =>  'required',
    ], [
        'name.required'     =>  'Name field is required. Please fill in your name.',
        'message.required'  =>  'Your forgot to type a message. Kindly write your message to proceed'
    ]);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $message = Testimony::create($data);
    Session::flash('success', 'Your Testimony has been sent and will be reviewed carefully before posting on our website.');
    // Mail::to('support@aspenafrica.org')->send(new \App\Mail\ContactMessage($message));
    return redirect()->back();
}

public function WorkForceRequest(Request $request) {
    $data = array(
        'name'      =>  $request->name,
        'body'   =>  $request->body,
        'email'     =>  $request->email,
        'phone'     =>  $request->phone,
        'city'   =>  $request->city,
        'state'   =>  $request->state,
        'department'   =>  $request->department,
    );

    $validator = Validator::make($data, [
        'name'      =>  'required|string|max:50',
        'email' => 'string', 'email', 'max:50', 'unique:work_force_requests',
        'body'   =>  'required',
        'phone'   =>  'required', 'max:15',
    ], [
        'name.required'     =>  'Name field is required. Please fill in your name.',
        'body.required'  =>  'Your forgot to type your reason. Kindly write your reason to proceed'
    ]);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $message = WorkForceRequest::create($data);
    Session::flash('success', ' Request was sent successfully, We will contact you as soon as possible if need be.');
    // Mail::to('support@aspenafrica.org')->send(new \App\Mail\ContactMessage($message));
    return redirect()->back();
}

}
