<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeeeeeymController extends Controller
{
    function receive()
    {
    	$data = $request->all();

	    //get the user’s id
	    $id = $data["entry"][0]["messaging"][0]["sender"]["id"];

	    $message = $data['entry'][0]['messaging'][0]['message']['text'];

	    if($message == 'David Mendoza')
	    {
	    	$response = "David's birthday is on November 12, 1997";
	    }
	    else if($message == 'Ranz Dalangin')
	    {
	    	$response = "Ranz's birthday is on November 19, 1995";
	    }
	    else if($message == 'Ivan Gellangao')
	    {
	    	$response = "Ivan's birthday is on December 30, 1996";
	    }
	    else
	    {
	    	$response = "Pakboi si jerome";
	    }

	    $this->sendTextMessage($id, $response);
    }

    private function sendTextMessage($recipientId, $messageText)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "message" => [
                "text" => $messageText
            ]
        ];
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);        
    }
}
