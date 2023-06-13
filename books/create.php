<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php include "../navbar.php"; ?>

<div class="mx-16">
    
    <form action="" method="post" enctype="multipart/form-data">

        <label for="cover">Book's Cover</label><br>
        <input type="file" name="cover" id="cover" required
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4"><br>

        <label for="title">Title</label><br>
        <input type="text" name="title" id="title" required
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="author">Author</label><br>
        <input type="text" name="author" id="author" required
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="publisher">Publisher</label><br>
        <input type="text" name="publisher" id="publisher" required
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="publication">Publication Year</label><br>
        <input type="year" name="pub_year" id="publication" required
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="pages">Pages</label><br>
        <input type="text" name="pages" id="pages" required
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="stock">Stock</label><br>
        <input type="text" name="stock" id="stock" required
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="description">Description</label><br>
        <input type="text" name="description" id="description"required maxlength="1000"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <label for="isbn">Isbn (optional)</label><br>
        <input type="text" name="isbn" id="isbn"
        class="border border-solid border-b-2 border-gray-400 rounded-sm mb-4 px-2"><br>

        <button type="submit" name="submit"
        class="border border-solid border-2 rounded-md px-4 py-2 border-gray-800 text-gray-800">
            Register
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
    $description      = $_POST["description"];

    $cfile = curl_file_create($_FILES['cover']['tmp_name'],$_FILES['cover']['type'],$_FILES['cover']['name']);

// User data to send using HTTP POST method in curl
$data = array(
    'cover'         => $cfile,
    'title'         => $title,
    'author'        => $author,
    'publisher'     => $publisher,
    'pub_year'      => $pub_year,
    'pages'         => $pages,
    'stock'         => $stock,
    'current_stock' => $stock,
    'description'   => $description,
);

// Data should be passed as json format
// $data_json = json_encode($data);

// API URL to send data
$url = 'http://127.0.0.1:8000/api/v1/books';

// curl initiate
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// SET Method as a POST
curl_setopt($ch, CURLOPT_POST, 1);

// Pass user data in POST command
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute curl and assign returned data
// $curlResponse = curl_exec($cURL);

// $jsonArrayResponse = json_decode($curlResponse);

$response  = curl_exec($ch);

// Close curl
curl_close($ch);

// See response if data is posted successfully or any error
// print_r ($response);

// redirect to book lists
header("Location: index.php");
die();

}
?>
</body>
</html>