
<?php



// Include the PHPMailer library
require 'vendor/autoload.php';
require 'capstone3/phpmailer/execution.php';
require 'capstone3/phpmailer/PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email-submit'])) {

  $email = $_POST["contact-email"];
  $to = $email;
  $subject = "Hello from CrimeAgg!";
  $message = "Thank you for contacting us! Our team will be in touch with you shortly!";

  // Create a new PHPMailer instance
  $mail = new PHPMailer();

  // Set the mailer to use SMTP
  $mail->isSMTP();

  // Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 0;

  // Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';

  // Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;

  // Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';

  // Set the SMTP authentication mechanism to use - plain or login
  $mail->SMTPAuth = true;

  // Set the username and password credentials
  $mail->Username = 'jhorgan3672@gmail.com';
  $mail->Password = 'PotatoBrotatoTriceratops!!20';

  // Set who the message is to be sent from
  $mail->setFrom('info@jeffhorgan.info', 'CrimeAgg');

  // Set who the message is to be sent to
  $mail->addAddress($to);

  // Set the subject line
  $mail->Subject = $subject;

  // Set the body of the message
  $mail->Body = $message;

  // Send the message
  if (!$mail->send()) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      header("Location: https://jeffhorgan.info/GoDaddy2/capstone3/index.html#contactus");
  }
}




?>