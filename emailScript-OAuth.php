<?php

//-------------------- SCRIPT SETUP --------------------//

/**
 * This example shows how to send via Google's Gmail servers using XOAUTH2 authentication.
 */

// Display PHP errors
ini_set( 'display_errors', 1 );

// Import PHPMailer classes into the global namespace - must be at the top of the script
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;

// Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

// Load Composer's autoloader - TODO: Set path to your atuload.php file
require '<PATH_TO_DIRECTORY>/vendor/autoload.php';

// Retrieve the POST parameters
$form_message = $_POST['message'];
$form_name = $_POST['name'];
$form_email = $_POST['email'];

// Create a new instance of PHP Mailer
$mail = new PHPMailer;

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

// Specify TCP port to connect to     
$mail->Port = 587;

// Enable TLS encryption
$mail->SMTPSecure = 'tls';

// Enable SMTP authentication
$mail->SMTPAuth = true;

// Set AuthType to use XOAUTH2
$mail->AuthType = 'XOAUTH2';

// Specify the email (account the mail will be sent from), clientId, clientSecret and refreshToken
// Follow this tutorial for more information : https://github.com/PHPMailer/PHPMailer/wiki/Using-Gmail-with-XOAUTH2
// TODO: Enter email, clientId, clientSecret and refreshToken
$email = '<EMAIL_HERE>';
$clientId = '<CLIENT_ID_HERE>';
$clientSecret = '<CLIENT_SECRET_HERE>';
$refreshToken = '<REFRESH_TOKEN_HERE>';

// Create a new OAuth2 provider instance
$provider = new Google([
    'clientId' => $clientId,
    'clientSecret' => $clientSecret
]);

// Pass the OAuth provider instance to PHPMailer
$mail->setOAuth(
    new OAuth([
        'provider' => $provider,
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
        'refreshToken' => $refreshToken,
        'userName' => $email
    ])
);

//-------------------- EMAIL SETTINGS - TODO: Edit the info here --------------------//

// Set the From Address (the same email used above)
$mail->setFrom($email, '<DISPLAY_NAME>');

// Add a recipient
$mail->addAddress($form_email, $form_name);

// Set the Subject line
$mail->Subject = '<SUBJECT>';

// Set the body of the email
$mail->Body = $form_message;

// Send the email, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}