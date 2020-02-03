<?php

//-------------------- SCRIPT SETUP --------------------//

// Display PHP errors
ini_set( 'display_errors', 1 );

// Import PHPMailer classes into the global namespace - must be at the top of the script
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader - TODO: Set path to your atuload.php file
require '<PATH_TO_DIRECTORY>/vendor/autoload.php';

// Retrieve the POST parameters
$message = $_POST['message'];
$name = $_POST['name'];
$email = $_POST['email'];

// Create a new instance of PHP Mailer, passing 'true' to enable exceptions
$mail = new PHPMailer(true);
try {

//-------------------- SERVER SETTINGS --------------------//
    
// Set mailer to use SMTP
$mail->isSMTP(); 

// Enable verbose debug output - set to 0 for final to avoid user from being able to see any sensitive info
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0; 
                                    
// Specify SMTP server, in this case, Google's SMTP Server
$mail->Host = 'smtp.gmail.com';  

// Enable SMTP authentication
$mail->SMTPAuth = true;       

// SMTP username / password (email will be sent using this Gmail account)
$mail->Username = 'YOUR_EMAIL_HERE'; //TODO: Put Email here     
$mail->Password = 'YOU_PASSWORD_HERE'; //TODO: Put Password here

// Enable TLS encryption
$mail->SMTPSecure = 'tls';     

// Specify TCP port to connect to 
$mail->Port = 587;

//-------------------- RECIPIENTS --------------------//
    
// NOTE: Names are optional

// From Address
$mail->setFrom('YOUR_EMAIL_HERE', 'YOUR_NAME_HERE');

// Add a Recipient
$mail->addAddress('john@example.com', 'John');

// Add a Reply-To Address
//$mail->addReplyTo('info@example.com', 'Information');

// Add a CC Address
//$mail->addCC('cc@example.com');

// Add a BCC Address
//$mail->addBCC('bcc@example.com');

//-------------------- ATTACHMENTS --------------------//
    
// NOTE: Names are optional

// Add attachment
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');

//-------------------- CONTENT --------------------//
    
// Set email format to HTML (if true)
$mail->isHTML(false); 

// Set Subject
$mail->Subject = 'This is the Subject';

// Set Body, you can append to it if you wish. In this case, the name, email and message of the person who filled out the form 
$mail->Body = 'Name: ' . $name . "\r\n";
$mail->Body .= 'Email: ' . $email . "\r\n\r\n";
$mail->Body .= 'Message: ' . $message;

// The body can include HTML if you wish
//$mail->Body = 'This is the HTML message body <b>in bold!</b>';

// If using HTML, you should set an Alternate Body that will be displayed for non-HTML mail clients
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//-------------------- SEND / VALIDATION --------------------//
    
// Send the Email
$mail->send();

// Echo message if email was sent properly
echo 'Message has been sent';

// If there was an exception, catch it, then echo the error
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

// Redirect to a URL once the script is complete
header('Location: https://google.com');

?>
