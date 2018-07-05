<?php
header('Content-Type: text/html; charset=UTF-8');
require('wp-load.php');
define('WP_USE_THEMES', true);



// lps_check_date('2018/07/09');





// this function will retrieve all aspirantes and execute lps_handle_inicio in each one of them
function lps_check_inicios(){
    $args = array(
		'post_type' => 'aspirantes',
        'post_status'    => 'publish',
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_id();
            $email = get_post_meta($post_id, 'OFI-1-AEmail', true);
            $inicio = get_post_meta($post_id, 'inicio_anualidad', true);

            lps_handle_inicio($inicio, $email, $post_id);

		}
	}
    
    return $post_id;
}




// DATE HANDLING

// date provided in format of database YYYYMMDD
// this function will receive the info of an aspirante and will send emails if $days_left is 30, 20 or 10
function lps_handle_inicio($date, $email, $post_id){
    $parsed_date = lps_parse_date($date);
    $days_left = lps_days_left($parsed_date);

    if ($days_left == 30){
        lps_send_reminder($parsed_date, $email);
        lps_change_status($post_id);
    } else if ($days_left == 20 || $days_left == 10 ){
        lps_send_reminder($parsed_date, $email);
    } else {
        echo 'Nothing will happen since there are '.$days_left.' days left';
    }
}

// date must be already parsed
// this function calculates how many days are left from today to the date given
function lps_days_left($parsed_date){
    $today = date_create(date("Y/m/d"));
    $date_obj = date_create($parsed_date);

    // check if date hasn't passed already
    if($today < $date_obj){
        //difference between two dates
        $diff = date_diff($today,$date_obj);
        return $diff->format("%a");
    } else {
        return 'invalid';
    }
}

// this function will parse the date from the database format to linux readable format
function lps_parse_date($unparsed){
    $year = substr($unparsed,0,4);
    $month = substr($unparsed,4,2);
    $day = substr($unparsed,6,2);

    return $year.'/'.$month.'/'.$day;
}

// EMAIL HANDLING
function lps_send_reminder($parsed_date, $email){
    // Set $to as the email you want to send the test to.
    $to = "gerarddo1234@gmail.com"; // $to = $email
    
    // Email subject and body text.
    $subject = 'Viendo por el mundo - Tu anualidad esta por vencer ';
    $message = 'Te recordamos que tu anualidad vencera el '.$parsed_date.' por lo que te recomendamos pagues lo antes posible para prevenir incovenientes.';
    $headers = '';

    $sent_message = wp_mail( $to, $subject, $message, $headers );

    //display message based on the result.
    if ( $sent_message ) {
        // If message was sent maybe do something in database to keep a record?
    } else {
        // Same as other branch but with another input in database
    }
}

function lps_change_status($post_id){
    update_post_meta($post_id, '_status', '01');
}



?>