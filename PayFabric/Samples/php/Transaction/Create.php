<?php

const DEVICE_ID = "49b8e79d-bc02-9295-fe09-a4112427490c";
const DEVICE_PASSWORD = "SamsonitePhp1";

class Transaction {

    public function create() {

        $card = Array("ID" => 
                "1e700b9f-3e43-4cc0-9a02-884dd4c7e6ee"); // Card ID. Generated by PayFabric. 
                                                         
        $transaction = Array(
                "Amount" => "1.12",
                "Customer" => "1", // Customer ID
                "Currency" => "USD",
                "SetupId" => "Strongtrans", // Payment Gateway name
                "Tender" => "CreditCard",
                "Type" => "Sale",
                "Card" => $card);

        // Convert the data to JSON.
        $json = json_encode($transaction, TRUE);

        // Setup the HTTP request.
        $httpUrl = "https://sandbox.payfabric.com/payment/api/transaction/create";
        $httpHeader = Array(
                "Content-Type: application/json",
                "authorization: " . DEVICE_ID . "|" . DEVICE_PASSWORD);        
        $curlOptions = Array(CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_VERBOSE => TRUE,
                CURLOPT_POSTFIELDS => $json,
                CURLOPT_HTTPHEADER => $httpHeader);

        // Execute the HTTP request.
        $curlHandle = curl_init($httpUrl);
        curl_setopt_array($curlHandle, $curlOptions);
        $httpResponseBody = curl_exec($curlHandle);
        $httpResponseCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);

        if ($httpResponseCode >= 300) {
            // Handle errors.
        }          

        // Convert the JSON into a multi-dimensional array.
        $responseArray = json_decode($httpResponseBody, TRUE);

        // Output the results of the request.
        var_dump($httpResponseBody);

        return $responseArray;        

    }

}

/* Example Response 
{"Key":"140821070484"}
*/

