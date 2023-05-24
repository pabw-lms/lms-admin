<?php

$id = $_GET['id'];

// Initiate curl session in a variable (resource)
$curl_handle = curl_init();

// $url = "https://dummy.restapiexample.com/api/v1/employees";
$url = "http://127.0.0.1:8000/api/v1/books/$id";

// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);

curl_close($curl_handle);

// Decode JSON into PHP array
$book = json_decode($curl_data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php include "../navbar.php"; ?>

<div class="mx-16">
    
    <form action="" method="post">

        <label for="title">Title</label><br>
        <input type="text" name="title" id="title"
        value="<?= $book->title ?>"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="author">Author</label><br>
        <input type="text" name="author" id="author"
        value="<?= $book->author ?>"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="publisher">Publisher</label><br>
        <input type="text" name="publisher" id="publisher"
        value="<?= $book->publisher ?>"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="publication">Publication Year</label><br>
        <input type="year" name="pub_year" id="publication"
        value="<?= $book->pub_year ?>"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="pages">Pages</label><br>
        <input type="text" name="pages" id="pages"
        value="<?= $book->pages ?>"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="stock">Stock</label><br>
        <input type="text" name="stock" id="stock"
        value="<?= $book->stock ?>"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="stock">Current stock</label><br>
        <input type="text" name="current_stock" id="stock"
        value="<?= $book->current_stock ?>"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>


        <label for="isbn">Isbn (optional)</label><br>
        <input type="text" name="isbn" id="isbn"
        value="<?= $book->isbn ?>"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <button type="submit" name="submit"
        class="border border-solid border-2 rounded-md px-4 py-2 border-gray-800 text-gray-800">
            Update
        </button>
    </form>
</div>

<?php

if(isset($_POST["submit"])){
    $title      = $_POST["title"];
    $author     = $_POST["author"];
    $publisher  = $_POST["publisher"];
    $pub_year   = $_POST["pub_year"];
    $pages      = $_POST["pages"];
    $stock      = $_POST["stock"];
    $current_stock      = $_POST["current_stock"];

// User data to send using HTTP POST method in curl
$data = array(
    'title'         => $title,
    'author'        => $author,
    'publisher'     => $publisher,
    'pub_year'      => $pub_year,
    'pages'         => $pages,
    'stock'         => $stock,
    'current_stock' => $current_stock,
);

// User data to send using HTTP PUT method in curl

// Data should be passed as json format
$data_json = json_encode($data);

// API URL to update data with employee id
$url = "http://127.0.0.1:8000/api/v1/books/$id";

// curl initiate
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));

// SET Method as a PUT
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

// Pass user data in POST command
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute curl and assign returned data
$response  = curl_exec($ch);

// Close curl
curl_close($ch);

// See response if data is posted successfully or any error
// print_r ($response);

// redirect to book lists
header("Location: index.php");

} 
?>