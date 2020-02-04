# PHPEmailExamples

PHP Scripts that can be used to send encrypted emails with Google's SMTP Server using the PHPMailer Library and Composer. One script requires you to enter the email and password, the other uses XOAuth with GMail to send emails using a client ID, client secret and refresh token. These fields can be reteieved by using the GMail API. Both scripts are currently setup to accept an email, name and message from an HTML form with a POST request.

Scripts based off of the following:

https://github.com/PHPMailer/PHPMailer
https://github.com/PHPMailer/PHPMailer/wiki/Using-Gmail-with-XOAUTH2
