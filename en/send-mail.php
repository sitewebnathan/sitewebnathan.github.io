<?php

$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
$headers .= "Content-Transfer-Encoding: 8bit";

/* ==============================================
Variables you can change
============================================== */

$mailto = 'contact@cooking-nathan.com'; // Enter your mail addres here. 
$subject = 'Message reçu sur le site internet'; // Enter the subject here.

$error_message = 'Your message could not be sent. Please try again.'; // Message displayed if an error occurs
$success_message = 'Your message was correctly sent. Thank you. I will get back to you at the earliest convenience.'; // Message displayed id the email has been sent successfully

$human_test = true; // True / False, you want to use the "human test" or not?
$human_right_answer = '7'; // The correct answer to the question
$error_not_human = 'Invalid answer to the security question. Please try again'; // Message displayed when the "human" test fails


/* ==============================================
Do not modify anything below
============================================== */

$frm_name = stripcslashes($_POST['name']);
$frm_email = stripcslashes($_POST['email']);
$frm_message = stripcslashes($_POST['message']);

if($human_test == true) {
	$frm_check = stripcslashes($_POST['check']);
	if($frm_check != $human_right_answer ) {

		echo($error_not_human);
		exit;
		 
	}
}

$message = "Name: $frm_name\r\nEmail: $frm_email\r\nMessage: $frm_message";

$headers = "From: $frm_name <$frm_email>" . "\r\n" . "Reply-To: $frm_email" . "\r\n" . "X-Mailer: PHP/" . phpversion();

function validateEmail($email) {
   if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
	  return true;
   else
	  return false;
}

if((strlen($frm_name) < 1 ) || (strlen($frm_email) < 1 ) || (strlen($frm_message) < 1 ) || validateEmail($frm_email) == FALSE ) {

	echo($error_message);

} else {

	if( mail($mailto, $subject, $message, $headers) ) {
		
		echo($success_message);

	} else {

		echo($error_message);

	}

}

?>