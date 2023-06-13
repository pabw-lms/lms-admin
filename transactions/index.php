<?php
// Initiate curl session in a variable (resource)
$curl_handle = curl_init();

// $url = "https://dummy.restapiexample.com/api/v1/employees";
$url = "http://127.0.0.1:8000/api/v1/transactions";

// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);

curl_close($curl_handle);

$curl_handle = curl_init();

// $url = "https://dummy.restapiexample.com/api/v1/employees";
$url = "http://127.0.0.1:8000/api/v1/transactions";

// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);

curl_close($curl_handle);

// Decode JSON into PHP array
$transactions = json_decode($curl_data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction | index</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

</head>
<body>
    <?php include "../navbar.php"; ?>

    <table class="table-auto w-screen">
        <tr>
            <th class="border border-solid border-2 border-gray-800">ID</th>
            <th class="border border-solid border-2 border-gray-800">Borrowed At</th>
            <th class="border border-solid border-2 border-gray-800">Returned At</th>
            <th class="border border-solid border-2 border-gray-800">Status</th>
            <th class="border border-solid border-2 border-gray-800">Action</th>
        </tr>
        <?php
        // Traverse array and print employee data
        foreach ($transactions as $transaction) { ?>
        <tr>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $transaction->id ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $transaction->borrowed_at ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $transaction->returned_at ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $transaction->status ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1">
                <a href="show.php?trans_id=<?= $transaction->id ?>&book_id=<?= $transaction->book_id ?>&user_id=<?= $transaction->user_id ?>" class=":hover underline">Show more</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>