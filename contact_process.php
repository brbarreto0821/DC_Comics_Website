<?php

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'email_validation.php';

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);
$subject = "Inline Hockey Site Message";

$phone = stripslashes($_POST['Phone']);
$last = stripslashes($_POST['last-name']);
$message = stripslashes($_POST['message']). "\n".$name." ".$last."\nPhone: ".$phone;


$error = '';

// Check name

if(!$name)
{
$error .= 'Please enter your name.<br />';
}

// Check email

if(!$email)
{
$error .= 'Please enter a good e-mail address.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Please enter a valid e-mail address.<br />';
}

// Check message (length)

if(!$message || strlen($message) < 10)
{
$error .= "Please enter your message. It should have at least 10 characters.<br />";
}


if(!$error)
{
$mail = mail('bubba@bbarreto.campbellits.net', $subject, $message,
     "From: ".$name." <".$email.">\r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion());


if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>