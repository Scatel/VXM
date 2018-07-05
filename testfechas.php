<?php
header('Content-Type: text/html; charset=UTF-8');
require('wp-load.php');
define('WP_USE_THEMES', true);


DO_IT_FECHAS();

// $args = array(
//     ''
// )

// echo parse_dates($args)



function DO_IT_FECHAS(){
    $dates = array();
    $emails = array();
    $filename = "INICIOSANUALIDAD5.csv";

    $CSVfp = fopen($filename, "r");
    if($CSVfp !== FALSE) {
        while(! feof($CSVfp)) {
            $data = fgetcsv($CSVfp, 1000, ",");

            array_push($dates, $data['1']);
            array_push($emails, $data['0']);
        }
    }

    echo '<h4>'.$filename.'</h4>';
  
    // parse_dates is already functional, let's start working on inserting dates in db
    $parsed_dates = parse_dates($dates);

    // first we're going to test this function on the browser, later in db
    insert_dates_in_db($emails, $parsed_dates);
}

function insert_dates_in_db($emails, $dates){
    for($i = 0; $i < sizeof($emails); $i++){
        $post_id = search_id_by_email($emails[$i]);
        if($post_id !== 'not_found'){
            $aspirante_meta = array();
            $aspirante_meta['inicio_anualidad'] = $dates[$i];
            echo $post_id.','.$emails[$i].','.$dates[$i];
            echo '<br>';
            insert_aspirante_post_metas($post_id, $aspirante_meta);
        } else {
            echo 'not_found,'.$emails[$i].','.$dates[$i];
            echo '<br>';
        }
    }
}

function search_id_by_email($email){
    $args = array(
		'post_type' => 'aspirantes',
		'numberposts' => 1,
        'post_status'    => 'publish',
        'meta_key' => 'OFI-1-AEmail',
        'meta_value' => $email
	);

	$query = new WP_Query( $args );

    $post_id = 'not_found';

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_id();
		}
	}
    
    return $post_id;
}

function insert_aspirante_post_metas($post_id, $aspirante_meta){
    $aspirante = array();
    $aspirante['inicio_anualidad'] = $aspirante_meta['inicio_anualidad'];

    $meta_keys = array(
        'inicio_anualidad',   
        '_inicio_anualidad',
    );
    $meta_values = array(
        $aspirante['inicio_anualidad'],
        'field_5b16f4fb1bfb4',
    );

    for ($k = 0; $k <= sizeof($meta_values); $k++){
        add_post_meta( $post_id, $meta_keys[$k], $meta_values[$k] );
    }
}

function parse_dates($dates){
    $parsed = array();

    for($i = 0; $i < sizeof($dates); $i++){
        $day = substr($dates[$i],0,2);
        $month = substr($dates[$i],3,2);
        $year = substr($dates[$i],6,4);

        array_push($parsed, $year.$month.$day);
    }

    return $parsed;
}




