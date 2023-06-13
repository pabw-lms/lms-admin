    <?php
        // $curl_handle = curl_init();

        // // $url = "https://dummy.restapiexample.com/api/v1/employees";
        // $url = "http://127.0.0.1:8000/api/v1/logout";
        
        // // Set the curl URL option
        // curl_setopt($curl_handle, CURLOPT_URL, $url);
        
        // // This option will return data as a string instead of direct output
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        
        // // Execute curl & store data in a variable
        // $curl_data = curl_exec($curl_handle);
        
        // curl_close($curl_handle);
        
        // // Decode JSON into PHP array
        // $books = json_decode($curl_data);
        
    ?>
    <nav class="flex flex-row p-4 justify-between border border-solid border-b-2">
        <div class="px-3 py-1 m-2">
            <div class="font-bold">Library Management System</div>
        </div>
        <div class="flex flex-row ">
            <div class="px-3 py-1 m-2">
                <a href="/../lms-admin/dashboard.php">Dashboard</a>
            </div>
            <div class="px-3 py-1 m-2">
                <a href="/../lms-admin/transactions/index.php">Transactions</a>
            </div>
            <div class="px-3 py-1 m-2">
                <a href="/../lms-admin/books/index.php">Books</a>
            </div>
            <div class="px-3 py-1 m-2">
                <a href="/../lms-admin/members/index.php">Members</a>
            </div>
            <div class="px-3 py-1 m-2">
                Logout
            </div>
        </div>
    </nav>
