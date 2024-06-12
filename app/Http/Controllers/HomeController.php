<?php

namespace App\Http\Controllers;


use App\Models\PapaContactMessage;
use App\Models\PrayerRequest;
use App\Models\FAQ;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\PapaGallery;
use App\Models\Quote;
use App\Models\Sermon;
use App\Models\Bio;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Http;

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

        $galleries = PapaGallery::inRandomOrder()->take(8)->get();
        // $events = Event::orderBy('id', 'desc')->get();
        $bios = Bio::orderBy('id', 'desc')->get();

                    // Fetch data from the first API endpoint
        $response1 = Http::get('https://app.householdoflove.org/api/v1/quotes');

        // Fetch data from the second API endpoint
        $response2 = Http::get('https://app.householdoflove.org/api/v1/sermons');

        $response3 = Http::get('https://app.householdoflove.org/api/v1/events');

        $data1 = [];
        $data2 = [];
        $data3 = [];

        // Check if the first request was successful
        if ($response1->successful()) {
            $data1 = $response1->json();
        } else {
            // Log the error or handle it as needed
            \Log::error('Failed to fetch data from the first API endpoint.');
        }

        // Check if the second request was successful
        if ($response2->successful()) {
            $data2 = $response2->json();
        } else {
            // Log the error or handle it as needed
            \Log::error('Failed to fetch data from the second API endpoint.');
        }

        // Check if the second request was successful
        if ($response3->successful()) {
            $data3 = $response3->json();
        } else {
            // Log the error or handle it as needed
            \Log::error('Failed to fetch data from the second API endpoint.');
        }

            return view('welcome', compact('data1', 'galleries', 'data2', 'bios', 'data3'));


    }

    public function Gallery()
    {

        $projects = PapaGallery::orderBy('id', 'desc')->paginate(20);

        return view('gallery', compact('projects'));
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



        $message = PapaContactMessage::create($data);
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


}
