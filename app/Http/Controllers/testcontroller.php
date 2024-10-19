<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;



class testcontroller extends Controller
{
    public function index()
    {
        // Set your free TextBelt API key
        $apiKey = 'textbelt'; // 'textbelt' is the free demo key, you can replace it with your own if you upgrade

        // Create a new Guzzle client
        $client = new Client();

        // Get the phone number and message from the request (you can modify this as needed)
        $phone = '+93784069777';
        $message = 'Hi this is Ahmad';

        // Send the SMS via TextBelt API
        $response = $client->post('https://textbelt.com/text', [
            'form_params' => [
                'phone' => $phone,
                'message' => $message,
                'key' => $apiKey
            ]
        ]);

        // Get the response and decode it
        $responseBody = json_decode($response->getBody(), true);

        // Check if the SMS was successfully sent
        if ($responseBody['success']) {
            return response()->json(['message' => 'SMS sent successfully.']);
        } else {
            return response()->json(['error' => $responseBody['error']], 400);
        }
    }
    public function sendSms(Request $request)
    {
        // $sid = env('TWILIO_SID');
        // $token = env('TWILIO_TOKEN');
        // $from = '+93779404681'; // Your verified Twilio phone number

        // // Create a new Twilio Client
        // $twilio = new Client($sid, $token);

        // // Send the SMS
        // $message = $twilio->messages->create(
        //     '+93784069777', // The phone number you want to send to
        //     [
        //         'from' => $from,        // Your verified Twilio phone number
        //         'body' => 'the problem of is fxed ' // The message body
        //     ]
        // );

        // // Check if the message was successfully sent
        // if ($message->sid) {
        //     return response()->json(['message' => 'SMS sent successfully.']);
        // } else {
        //     return response()->json(['error' => 'Failed to send SMS'], 400);
        // }
    }

}
