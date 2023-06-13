<?php



if(isset($_POST["submit"]) && $_POST['password'] == $_POST['password_confirmation']){
    $name       = $_POST['name']; 
    $email      = $_POST["email"];
    $password   = $_POST["password"];

// User data to send using HTTP POST method in curl
$data = array(
    'name'                  => $name,
    'email'                 => $email,
    'role'                  => 'admin',
    'password'              => $password,
    'password_confirmation' => $password,
);

// Data should be passed as json format
$data_json = json_encode($data);

// API URL to send data
$url = 'http://127.0.0.1:8000/api/v1/auth/register';

// curl initiate
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// SET Method as a POST
curl_setopt($ch, CURLOPT_POST, 1);

// Pass user data in POST command
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute curl and assign returned data
$response  = curl_exec($ch);

// Close curl
curl_close($ch);

// See response if data is posted successfully or any error
var_dump($response);

// redirect to book lists
// header("Location: index.php");
// die();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center h-screen bg-sky-950">
    <div class="flex flex-col items-center p-6 bg-gray-100 rounded-md shadow-2xl">
        <h1 class="font-bold text-xl m-4">Register</h1>

        <form action="" method="post">
            <input type="text" name="name" placeholder="Enter your username" required
            class="px-2 py-1 w-full rounded"><br><br>    
        
            <input type="email" name="email" placeholder="Enter your e-mail" required
            class="px-2 py-1 w-full rounded"><br><br>

            <input type="password" name="password" placeholder="Enter your password"required
            class="px-2 py-1 w-full rounded"><br><br>

            <input type="password" name="password_confirmation" placeholder="Confirm password"required
            class="px-2 py-1 w-full rounded"><br><br>

            <a href="login.php" class="mx-2 underline text-gray-800">Already have an account?</a>
            <button type="submit" class="bg-gray-800 rounded text-white px-4 py-2 mx-2">Register</button>
        </form>
    </div>


</body>
</html>
</body>
</html>