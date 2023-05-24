<?php
session_start();
$id = $_GET['id'];

// User data to send using HTTP POST method in curl
$data = array();

// Data should be passed as json format
$data_json = json_encode($data);

// API URL to send data
$url = "http://127.0.0.1:8000/api/v1/books/$id";

// curl intitite
$curl_handle = curl_init();

curl_setopt($curl_handle, CURLOPT_URL, $url);

// Set json header to received json response properly
curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));

// SET Method as a DELETE
curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");

// Pass user data in POST command
curl_setopt($curl_handle, CURLOPT_POSTFIELDS,$data_json);

curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl and assign returned data into
$response  = curl_exec($curl_handle);

// Close curl
curl_close($curl_handle);

// See response if data is posted successfully or any error
print_r ($response);

// redirect to book lists
header("Location: index.php");

?>