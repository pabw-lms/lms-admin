<?php

// session_start();

$title = $_GET['title'];

// Initiate curl session in a variable (resource)
$curl_handle = curl_init();

// $url = "https://dummy.restapiexample.com/api/v1/employees";
$url = "http://127.0.0.1:8000/api/v1/books/search/" . $title;

// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);

curl_close($curl_handle);

// Decode JSON into PHP array
$books = json_decode($curl_data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Lists</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] {
			display: none;
		}
    </style>
</head>
<body class="m-0 p-0">

    <?php include "../navbar.php"; ?>
    <div class="flex flex-row justify-between align-center px-4 py-2 border border-solid border-b-2">
        <div class="px-3 py-1 m-2">
            <div class="font-bold">Book Lists</div>
        </div>
        <div class="flex items-center m-2">

            <button class="bg-lime-500 rounded-md text-white font-semibold px-4 py-2">
                <a href="/../lms-admin/books/create.php">New +</a>
            </button>
        </div>
    </div>
    <div class="flex justify-start px-8 py-2">
        <form action="" method="post">
            <button type="submit" name="submit" class="bg-gray-200 rounded text-gray-800 font-semibold px-2 py-1 border border-solid border-2 border-gray-200">
                Search
            </button>
            <input placeholder="Search book's title" type="search" name="search-input" id="search" class="border border-solid border-2 border-gray-200 rounded px-2 py-1" required>    
        </form>
        <?php
            if(isset($_POST['submit'])) { 
                header("Location: search.php?title=".$_POST['search-input']);
            }
        ?>
    </div>

    <table class="table-auto w-full">
        <tr>
            <th class="border border-solid border-2 border-gray-800">Cover</th>
            <th class="border border-solid border-2 border-gray-800">Title</th>
            <th class="border border-solid border-2 border-gray-800">Author</th>
            <th class="border border-solid border-2 border-gray-800">Publisher</th>
            <th class="border border-solid border-2 border-gray-800">stock</th>
            <th class="border border-solid border-2 border-gray-800">current</th>
            <th class="border border-solid border-2 border-gray-800">Action</th>
        </tr>

        <?php
        // Traverse array and print employee data
        foreach ($books as $book) { ?> 
        <tr>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1">
                <div class="flex justify-center">
                    <img src="<?= $book->cover ?>" style="width: 180px; height: 260px;">
                </div>
            </td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $book->title ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $book->author ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $book->publisher ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $book->stock ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1"><?= $book->current_stock ?></td>
            <td class="border border-solid border-2 border-gray-800 px-2 py-1">
                <div class="flex flex-row">
                    <a type="button" href="/../lms-admin/books/update.php?id=<?= $book->id ?>"
                        class="mx-2 px-4 py-2 bg-amber-600 font-semibold rounded-md text-white">
                        Edit
                    </a>

                    <!-- Modals -->
                    <div x-data="{ modelOpen: false }">
                        <button @click="modelOpen =!modelOpen" class="mx-2 px-4 py-2 bg-red-600 font-semibold rounded-md text-white">
                            <span>Delete</span>
                        </button>
                    
                        <div  x-cloak x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                <div @click="modelOpen = false" x-show="modelOpen" 
                                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                                ></div>
                                <div x-show="modelOpen" 
                                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                    <div class="flex justify-end">
                                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-center space-x-4">
                                        <h1 class="text-xl font-medium text-gray-800 ">Confirm Delete?</h1>
                                    </div>
                                    <form class="mt-5">
                                        <div class="flex justify-center mt-6">
                                            <button @click="modelOpen = false" type="button" class="px-4 py-2 mx-2 font-semibold text-lime-600 rounded-md border border-solid border-lime-600 ">
                                                Cancel
                                            </button>
                                            <a href="/../lms-admin/books/delete.php?id=<?= $book->id ?>"
                                                type="button" class="px-4 py-2 mx-2 font-semibold text-white rounded-md bg-red-600">
                                                Delete
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>

