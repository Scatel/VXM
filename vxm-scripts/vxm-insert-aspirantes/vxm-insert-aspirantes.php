<?php

header('Content-Type: text/html; charset=UTF-8'); 
require('../../wp-load.php');
define('WP_USE_THEMES', true);

require( plugin_dir_path(__FILE__).'vxm-insert-aspirantes-functions.php' );
require( plugin_dir_path(__FILE__).'vxm-aspirantes-fields.php');

// include_once( plugin_dir_path(__FILE__).'vxm-scripts/vxm-insert-aspirantes/vxm-aspirantes-fields.php' );


////////////////////////////////////////////////////////////////////////
// t=To make this work on a slow computer (such as mine) you have to manually change the name of the file
// you want to load in the parse_aspirante_infos function

// these are the primary functions, before doing anything make sure that fields are
// right in all functions, most importantly   parse_aspirante_infos   and   insert_aspirante_post_meta



////////////////////////////////////////////////////////////////////////   
$instructores_field_index = instructores_field_index();
$aspirante_metas = parse_aspirante_metas($instructores_field_index);
$tipo_aspirante = 'instructor';

// $certificadores_field_index = certificadores_field_index();
// $aspirante_metas = parse_aspirante_metas($certificadores_field_index);
// $tipo_aspirante = 'certificador';

insert_aspirantes($aspirante_metas, $tipo_aspirante);


// insertar a vere
// insert_aspirante_with_user($aspirante_metas[1], 'certificador', 760);

// insertar a noe
// insert_aspirante_with_user($aspirante_metas[0], 'certificador', 713);




function parse_aspirante_metas($aspirantes_field_index){
    $aspirante_metas = array();
    echo '<br>';
    echo '<br>';
    // //echo the name of the file you're currently inserting intro database
    // echo '14jun_info_aspirantes/14jun_aspirantes_faltantes_info1.csv';
    // echo '<br>';
    // echo '<br>';
    // already tried to put a variable instead of hardcoded text, doesn't work
    // be careful if you want to see it not working for yourself
    $CSVfp = fopen("csv_instructores/info_16.csv", "r");
    $fields = array_keys($aspirantes_field_index);
    if($CSVfp !== FALSE) {
        while(! feof($CSVfp)) {
            $data = fgetcsv($CSVfp, 1000, ",");
            for($i = 0; $i < sizeof($fields); $i++){
                $field = $fields[$i];
                $index = $aspirantes_field_index[$field] - 1;
                $aspirante_meta[$field] = $data[$index];
            }
            array_push($aspirante_metas,$aspirante_meta);
        }
    }
    fclose($CSVfp);
    return $aspirante_metas;
}

