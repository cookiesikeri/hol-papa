<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Unicodeveloper\Paystack\Facades\Paystack;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use Flutterwave\Rave;
// use Flutterwave\Rave\EventHandlerInterface;
use GuzzleHttp\Client;
// use Flutterwave\Flutterwave;

use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{


    // public function initialize(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'amount' => 'required|numeric',
    //         'fname' => 'required|max:50',
    //         'lname' => 'required|max:50',
    //         'phone' => 'nullable|string|max:20',
    //         'comment' => 'nullable',
    //         'currency' => 'required',
    //         'offering_type' => 'required',
    //     ]);

    //     $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
    //         ->post('https://api.paystack.co/transaction/initialize', [
    //             'email' => $request->email,
    //             'phone' => $request->phone,
    //             'fname' => $request->fname,
    //             'lname' => $request->lname,
    //             'offering_type' => $request->offering_type,
    //             'comment' => $request->comment,
    //             'currency' => $request->currency,
    //             'amount' => $request->amount * 100, // Paystack accepts amounts in kobo
    //         ]);

    //     if ($response->successful()) {
    //         return redirect($response->json()['data']['authorization_url']);
    //     }

    //     return back()->withErrors(['error' => 'Unable to initialize payment']);
    // }

    // public function verify(Request $request)
    // {
    //     $paymentReference = $request->query('reference');

    //     $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
    //         ->get("https://api.paystack.co/transaction/verify/{$paymentReference}");

    //     if ($response->successful()) {
    //         $data = $response->json()['data'];
    //         if ($data['status'] == 'success') {
    //             // Payment was successful, you can now handle the successful payment logic
    //             $payment = Payment::create([
    //                 'fname' => $data['metadata']['fname'],
    //                 'lname' => $data['metadata']['lname'],
    //                 'currency' => $data['metadata']['currency'],
    //                 'offering_type' => $data['metadata']['offering_type'],
    //                 'comment' => $data['metadata']['comment'],
    //                 'email' => $data['customer']['email'],
    //                 'phone' => $data['metadata']['phone'],
    //                 'amount' => $data['amount'] / 100, // Convert kobo to naira
    //                 'reference' => $data['reference'],
    //                 'status' => $data['status'],
    //             ]);
    //             return view('payment.success', ['data' => $data]);
    //         }
    //     }

    //     return view('payment.error');
    // }


    public function initiatePaymentPaysack(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'amount' => 'required|numeric',
            'offering_type' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $request->merge([
            'orderID' => uniqid(),
            'amount' => $validatedData['amount'] * 100, // Paystack requires the amount in kobo
            'quantity' => 1,
            'currency' => 'NGN',
            'metadata' => json_encode([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone' => $validatedData['phone'],
                'offering_type' => $validatedData['offering_type'],
                'comment' => $validatedData['comment'],
            ]),
            'reference' => Paystack::genTranxRef(),
            'email' => $validatedData['email'],
        ]);

        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    public function handleCallbackPaystack()
    {
        $paymentDetails = Paystack::getPaymentData();

        if ($paymentDetails['status'] == 'success') {
            $metadata = $paymentDetails['data']['metadata'];
            $payment = new Payment();
            $payment->transaction_id = $paymentDetails['data']['id'];
            $payment->amount = $paymentDetails['data']['amount'] / 100;
            $payment->currency = $paymentDetails['data']['currency'];
            $payment->email = $paymentDetails['data']['customer']['email'];
            $payment->first_name = $metadata['first_name'];
            $payment->last_name = $metadata['last_name'];
            $payment->phone = $metadata['phone'];
            $payment->offering_type = $metadata['offering_type'];
            $payment->comment = $metadata['comment'];
            $payment->status = $paymentDetails['data']['status'];
            $payment->save();

            // return redirect()->route('payment.success')->with('success', 'Payment successful');
            return redirect()->route('payment.success', ['transaction' => $paymentDetails]);


        }

        return redirect()->route('payment.error')->with('error', 'Payment failed or cancelled');
    }

//flutterwave
    // public function initiatePayment(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'amount' => 'required|numeric',
    //         'email' => 'required|email',
    //         'first_name' => 'required|string',
    //         'last_name' => 'required|string',
    //         'phone' => 'required|string',
    //         'offering_type' => 'required',
    //         'comment' => 'nullable|string',

    //     ]);

    //     $data = [
    //         'tx_ref' => uniqid(),
    //         'amount' => $validatedData['amount'],
    //         'currency' => 'NGN',
    //         'redirect_url' => route('flutterpayment.callback'),
    //         'customer' => [
    //             'email' => $validatedData['email'],
    //             'name' => $validatedData['name'],
    //             'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
    //             'phone_number' => $validatedData['phone'],
    //         ],
    //         'customizations' => [
    //             'title' => 'Household Of Love Online Giving',
    //             'description' => 'Household Of Love Online Giving',
    //         ],
    //         'meta' => [
    //             'offering_type' => $validatedData['offering_type'],
    //             'comment' => $validatedData['comment'],
    //         ],
    //     ];

    //     $client = new Client();
    //     $response = $client->post('https://api.flutterwave.com/v3/payments', [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . env('FLUTTERWAVE_SECRET_KEY'),
    //             'Content-Type' => 'application/json'
    //         ],
    //         'body' => json_encode($data)
    //     ]);

    //     $result = json_decode($response->getBody(), true);

    //     if ($result['status'] == 'success') {
    //         return redirect($result['data']['link']);
    //     }

    //     return back()->with('error', 'Something went wrong');
    // }

    // public function handleCallback(Request $request)
    // {
    //     $status = $request->status;

    //     if ($status == 'successful') {
    //         $transactionID = $request->transaction_id;

    //         $client = new Client();
    //         $response = $client->get('https://api.flutterwave.com/v3/transactions/' . $transactionID . '/verify', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . env('FLUTTERWAVE_SECRET_KEY'),
    //             ],
    //         ]);

    //         $result = json_decode($response->getBody(), true);

    //         if ($result['status'] == 'success') {
    //             $payment = new Payment();
    //             $payment->transaction_id = $result['data']['id'];
    //             $payment->amount = $result['data']['amount'];
    //             $payment->currency = $result['data']['currency'];
    //             $payment->email = $result['data']['customer']['email'];
    //             $payment->first_name = $result['data']['customer']['name']['first_name'];
    //             $payment->last_name = $result['data']['customer']['name']['last_name'];
    //             $payment->phone = $result['data']['customer']['phone_number'];
    //             $payment->offering_type = $result['data']['meta']['offering_type'];
    //             $payment->comment = $result['data']['meta']['comment'];
    //             $payment->status = $result['data']['status'];
    //             $payment->save();

    //             // return redirect()->route('payment.success')->with('success', 'Payment successful');
    //             return redirect()->route('payment.success', ['transaction' => $paymentDetails]);
    //         }

    //     }

    //     return redirect()->route('payment.error')->with('error', 'Payment failed or cancelled');
    // }

    public function initiatePayment(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'amount' => 'required|numeric',
            'offering_type' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $reference = Flutterwave::generateReference();

        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $validatedData['amount'],
            'email' => $validatedData['email'],
            'tx_ref' => $reference,
            'currency' => 'NGN',
            'redirect_url' => route('flutterpayment.callback'),
            'customer' => [
                'email' => $validatedData['email'],
                'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                'phone_number' => $validatedData['phone'],
            ],
            'meta' => [
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone' => $validatedData['phone'],
                'offering_type' => $validatedData['offering_type'],
                'comment' => $validatedData['comment'],
            ],
            'customizations' => [
                'title' => 'Payment for ' . $validatedData['offering_type'],
                'description' => $validatedData['comment'],
            ]
        ];

        $payment = Flutterwave::initializePayment($data);

        if ($payment['status'] !== 'success') {
            return redirect()->back()->with('error', 'Unable to initiate payment');
        }

        return redirect($payment['data']['link']);
    }

    public function handleCallback()
    {
        $status = request()->status;

        if ($status == 'successful') {
            $transactionID = request()->transaction_id;
            $data = Flutterwave::verifyTransaction($transactionID);

            if ($data['status'] == 'success') {
                $payment = new Payment();
                $payment->transaction_id = $data['data']['id'];
                $payment->amount = $data['data']['amount'];
                $payment->currency = $data['data']['currency'];
                $payment->email = $data['data']['customer']['email'];
                $payment->first_name = $data['data']['meta']['first_name'];
                $payment->last_name = $data['data']['meta']['last_name'];
                $payment->phone = $data['data']['meta']['phone'];
                $payment->offering_type = $data['data']['meta']['offering_type'];
                $payment->comment = $data['data']['meta']['comment'];
                $payment->status = $data['data']['status'];
                $payment->save();

                return redirect()->route('payment.success', ['transaction' => $payment]);
            }

            return redirect()->route('payment.error');
        }

        return redirect()->route('payment.error');
    }


    public function paymentSuccess(Payment $transaction)
    {
        return view('payment.success', compact('transaction'));
    }

    public function CallbackError()
    {

        return view('payment.error');
    }


}

