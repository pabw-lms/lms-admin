<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>How to upload file using cURL in PHP</title>
</head>
<body>
   <?php

   if(isset($_POST['submit'])){

       if(isset($_FILES['file']['name'])){
           // Create a CURLFile object
           $cfile = curl_file_create($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']);

           $postRequest = array(
               'file' => $cfile,
               'num1' => 54
           );

           $cURL = curl_init('http://127.0.0.1:8000/api/v1/files');
           curl_setopt($cURL, CURLOPT_POSTFIELDS, $postRequest);
           curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

           if(curl_exec($cURL) === false){
                echo 'Curl error: ' . curl_error($cURL);
           }else{
                $curlResponse = curl_exec($cURL);

                $jsonArrayResponse = json_decode($curlResponse);

                echo "<pre>";
                print_r($jsonArrayResponse);
                echo "</pre>";
           }
           curl_close($cURL);
       }

   }
   ?>
   <form method="post" action="" enctype="multipart/form-data">
       <input type="file" name="file"> <br>
       <input type="submit" name="submit" value="Upload file">
   </form>
</body>
</html>