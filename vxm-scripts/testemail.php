<?php


// Load WP components, no themes.
// define('WP_USE_THEMES', true);
require('../wp-load.php');




// Set $to as the email you want to send the test to.
$to = "gerarddo1234@gmail.com";
 
// Email subject and body text.
$subject = 'Viendo por el mundo - Tu anualidad esta por vencer ';
$message = 'Te recordamos que tu anualidad vencera el '.$date.' por lo que te recomendamos pagues lo antes posible para prevenir incovenientes.';
$headers = '';
 
// Load WP components, no themes.
define('WP_USE_THEMES', false);
require('wp-load.php');
 
// send test message using wp_mail function.
$sent_message = wp_mail( $to, $subject, $message, $headers );
//display message based on the result.
if ( $sent_message ) {
    // The message was sent.
    echo 'The test message was sent. Check your email inbox.';
} else {
    // The message was not sent.
    echo 'The message was not sent!';
}





?>