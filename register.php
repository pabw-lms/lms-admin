<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center h-screen bg-gray-200">
    <div class="flex flex-col items-center p-4 bg-gray-100 rounded-md shadow-l">
        <h1 class="font-bold text-xl m-4">Register</h1>

        <form action="" method="post">
            <input type="email" name="email" placeholder="Enter your e-mail"
            class="px-2 py-1 w-full rounded"><br><br>
            <input type="password" name="password" placeholder="Enter your password"
            class="px-2 py-1 w-full rounded"><br><br>
            <a href="login.php" class="mx-2 underline text-gray-800">Already have an account?</a>
            <button type="submit" class="bg-gray-800 rounded text-white px-4 py-2 mx-2">Register</button>
        </form>
    </div>
</body>
</html>