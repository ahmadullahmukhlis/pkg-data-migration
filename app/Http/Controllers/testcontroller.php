<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
}
