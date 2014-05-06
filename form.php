<?php
if (isset($_POST['name'], $_POST['email'], $_POST['url'], $_POST['message'])) {

	// Email address sending to 
    $to = "jackdeadman@ymail.com";
    $from = $_POST['email']; // Email address user entered
    $subject = "Feedback from " . $_POST['name']; // Subject of the email 

    //start of HTML message 
    $message ="
	<html> 
	  <body> 
	  	<div><b>Name:</b> {$_POST['name']}</div>
	  	<div><b>Email:</b> {$_POST['email']}</div>
	  	<div><b>Website:</b> <a href=\"{$_POST['url']}\">{$_POST['url']}</a></div>
	  	<div><b>Message: </b></div>
	    <p style=\"background-color:#abc;border:1px solid #456;border-radius:3px;padding:10px;\">
	        " . nl2br($_POST['message']) . " 
	    </p>
	  </body>
	</html>";
   //end of message 

	// Header information such as whom the email is from and the MIME type 
    $headers  = "From: $from\r\n"; 
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers); 

}else {
	// Triggered when not all required post data was sent
	echo 'Not enough data was sent <a href="form.html">Back</a>';
	die();
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Feedback</title>
</head>
<body>
	<div>
		Thank you for your feedback <a href="form.html">Back</a>
	</div>
</body>
</html>