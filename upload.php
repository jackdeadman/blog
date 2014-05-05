<?php
//header('Content-Type: application/json');
//if they DID upload a file...
$message = 'Error'; //Need FILE PERMISSION
echo $_FILES['file']['tmp_name'];

// if(move_uploaded_file($_FILES['file']['tmp_name'], 'img/users/' . basename($_FILES['file']['name'])))
// {
//     die('Success! File Uploaded.');
// }
// else
// {
//     die('error uploading File!');
// }
?>