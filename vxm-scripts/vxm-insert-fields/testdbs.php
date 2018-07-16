<?php


header('Content-Type: text/html; charset=UTF-8');
require('../../wp-load.php');
define('WP_USE_THEMES', true);



$bdcu_post_type = "bdcu_entry";
$bdcu_field_meta_keys = array(
    "bdcu-idioma",
    "bdcu-num_imagen",
    "bdcu-num_renglon",
    "bdcu-imagen_parcial",
    "bdcu-simboliza",
    "_validate_email" 
);
$bdcu_field_ids = array();
$bdcu_field_ids["bdcu-idioma"] = "field_5b2bb6c8a09af";
$bdcu_field_ids["bdcu-num_imagen"] = "field_5b2bb6e7a09b0";
$bdcu_field_ids["bdcu-num_renglon"] = "field_5b2bb700a09b1";
$bdcu_field_ids["bdcu-imagen_parcial"] = "field_5b2bb726a09b2";
$bdcu_field_ids["bdcu-simboliza"] = "field_5b2bb742a09b3";
$bdcu_field_ids["_validate_email"] = "_validate_email";
$bdcu_indexes = array();
$bdcu_indexes["bdcu-idioma"] =  0;
$bdcu_indexes["bdcu-num_imagen"] = 1;
$bdcu_indexes["bdcu-num_renglon"] = 2;
$bdcu_indexes["bdcu-imagen_parcial"] = 3;
$bdcu_indexes["bdcu-simboliza"] = 4;
$bdcu_indexes["_validate_email"] = 5;


$bdre_post_type = "bdre_entry";
$bdre_field_meta_keys = array(
    "bdre-idioma",
    "bdre-num_imagen",
    "bdre-num_renglon",
    "bdre-orden_impresion",
    "bdre-codigo_opcion",
    "bdre-descripcion_opcion",
    "bdre-recomendacion_fem",
    "bdre-recomendacion_masc",
    "_validate_email" 
);
$bdre_field_ids = array();
$bdre_field_ids["bdre-idioma"] = "field_5b2bb4106d224";
$bdre_field_ids["bdre-num_imagen"] = "field_5b2bb4676d225";
$bdre_field_ids["bdre-num_renglon"] = "field_5b2bb49c6d226";
$bdre_field_ids["bdre-orden_impresion"] = "field_5b2bb4cc6d227";
$bdre_field_ids["bdre-codigo_opcion"] = "field_5b2bb4ed6d228";
$bdre_field_ids["bdre-descripcion_opcion"] = "field_5b2bb5066d229";
$bdre_field_ids["bdre-recomendacion_fem"] = "field_5b2bb5276d22a";
$bdre_field_ids["bdre-recomendacion_masc"] = "field_5b2bb53b6d22b";
$bdre_field_ids["_validate_email"] = "_validate_email";
$bdre_indexes = array();
$bdre_indexes["bdre-idioma"] = 0;
$bdre_indexes["bdre-num_imagen"] = 1;
$bdre_indexes["bdre-num_renglon"] = 2;
$bdre_indexes["bdre-orden_impresion"] = 3;
$bdre_indexes["bdre-codigo_opcion"] = 4;
$bdre_indexes["bdre-descripcion_opcion"] = 5;
$bdre_indexes["bdre-recomendacion_fem"] = 6;
$bdre_indexes["bdre-recomendacion_masc"] = 7;
$bdre_indexes["_validate_email"] = 8;



$bdim_post_type = "bdim_entry";
$bdim_field_meta_keys = array(
    "bdim-idioma",
    "bdim-num_imagen",
    "bdim-imagen",
    "bdim-descripcion_imagen",
    "_validate_email" 
);
$bdim_field_ids = array();
$bdim_field_ids["bdim-idioma"] = "field_5b2bb5ef325cc";
$bdim_field_ids["bdim-num_imagen"] = "field_5b2bb5fc325cd";
$bdim_field_ids["bdim-imagen"] = "field_5b2bb62f06df5";
$bdim_field_ids["bdim-descripcion_imagen"] = "field_5b2bb642785e1";
$bdim_field_ids["_validate_email"] = "_validate_email";
$bdim_indexes = array();
$bdim_indexes["bdim-idioma"] =  0;
$bdim_indexes["bdim-num_imagen"] = 1;
$bdim_indexes["bdim-imagen"] = 2;
$bdim_indexes["bdim-descripcion_imagen"] = 3;
$bdim_indexes["_validate_email"] = 4;





DO_IT($bdim_post_type,$bdim_field_meta_keys,$bdim_field_ids,$bdim_indexes);






function DO_IT($post_type, $field_meta_keys, $field_ids, $indexes){
    $field_infos = parse_field_info($field_meta_keys, $indexes);
    insert_fields($post_type, $field_meta_keys, $field_ids, $field_infos);
}

function parse_field_info($field_meta_keys, $indexes){
    $field_info = array();
    $field_infos = array();

    $CSVfp = fopen("BDIM/BDIM.csv", "r");
    if($CSVfp !== FALSE) {
        while(! feof($CSVfp)) {
            $data = fgetcsv($CSVfp, 1000, ",");
    
            for($i = 0; $i < sizeof($field_meta_keys); $i++){
                $key = $field_meta_keys[$i];
                $field_info[$key] = $data[$indexes[$key]];
            }
    
            array_push($field_infos,$field_info);
        }
    }
    fclose($CSVfp);
    return $field_infos;
}


function insert_fields($post_type, $field_meta_keys, $field_ids, $field_infos){
    for($i=0; $i <sizeof($field_infos);$i++){
        $field_meta_values = $field_infos[$i];
        insert_field($post_type, $field_meta_keys, $field_ids, $field_meta_values);
    }
}

function insert_field($post_type, $field_meta_keys, $field_ids, $field_meta_values){
    $post_id = insert_field_post($post_type, false);
    $field_meta_values['_validate_email'] = '';
    insert_field_post_meta($post_id, $field_meta_keys, $field_ids, $field_meta_values);
    echo '<br>';
}


function insert_field_post($post_type, $echo = true){
    // init $my_post
    $my_post = array();

    // Create $my_post object
    $my_post['post_author'] = 713;
    $my_post['post_status'] = 'publish';
    $my_post['comment_status'] = 'closed';
    $my_post['ping_status'] = 'closed';
    $my_post['post_type'] = $post_type;

    // Insert the post into the database
    $post_id = wp_insert_post($my_post); 

    // Update guid and post_name
    $args = array(
        'guid' => 'http://localhost/vxm/?'.$post_type.'='.$post_id,
        'post_name' => $post_id
    );
    wp_update_post( $args );

    // Check if echo or not
    if($echo == true){
        echo $post_id.',';
    }

    // return the generated id
    return $post_id;
}

function insert_field_post_meta($post_id, $field_meta_keys, $field_ids, $field_meta_values){

    $meta_keys = array();
    $meta_values = array();

    for($i = 0; $i < sizeof($field_meta_keys); $i++){

        $meta_key = $field_meta_keys[$i];
        array_push($meta_keys, $meta_key);
        array_push($meta_keys, '_'.$meta_key);

        array_push($meta_values, $field_meta_values[$meta_key]);
        array_push($meta_values, $field_ids[$meta_key]);
    }

    for ($k = 0; $k < sizeof($meta_values); $k++){
        echo $post_id.' '; echo $meta_keys[$k].' '; echo $meta_values[$k]; echo '<br>';
        add_post_meta($post_id, $meta_keys[$k], $meta_values[$k]);
    }
}


