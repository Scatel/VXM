<?php


header('Content-Type: text/html; charset=UTF-8'); 
require('../wp-load.php');
require_once(ABSPATH.'/wp-admin/includes/user.php');

define('WP_USE_THEMES', true);


function lps_delete_posts($post_type){
    global $wpdb;






    $keys = array_keys($where);
    $where_query = '';
    for($i = 0; $i < sizeof($keys) - 1; $i++){
        $where_query = $where_query.$keys[$i].' = '.$where[$keys[$i]].' AND ';
    }
    $where_query = $where_query.$keys[$i].' = '.$where[$keys[$i]].';';

    $row = $wpdb->get_row("SELECT ".$column." FROM ".$table." WHERE ".$where_query, 'ARRAY_A');

    if(sizeof($row) == 1){
        return $row[$column];
    } else {
        return $row;   
    }
}

function lps_retrieve_posts_IDs($post_type){
    global $wpdb;

    $ID_results = $wpdb->get_results('SELECT ID FROM aio_posts WHERE post_type = "'.$post_type.'"', 'ARRAY_N');
    $IDs = array();

    for($i=0;$i<sizeof($ID_results);$i++){
        array_push($IDs, $ID_results[$i][0]);
    }
    return $IDs;
}

function lps_retrieve_user_ID($post_id){
    global $wpdb;

    $user_id = $wpdb->get_col('SELECT meta_value FROM aio_postmeta WHERE post_id = '.$post_id.' AND meta_key = "_userid"');

    return $user_id[0];
}

// function lps_retrieve_users_IDs($posts_ids){
//     $IDs = array();
//     for($i=0;$i<sizeof($posts_ids);$i++){
//         $ID = lps_retrieve_user_ID($posts_ids[$i]);
//         array_push($IDs, $ID);
//     }
//     return $IDs;
// }

function lps_delete_aspirante($post_id, $user_id){
    wp_delete_post($post_id, true);
    wp_delete_user($user_id);
}

function lps_delete_aspirantes($posts_ids, $exceptions){
    print_r($exceptions);
    echo '<br>';
    // print_r($posts_ids);
    // echo '<br>';
    for($i=0;$i<sizeof($exceptions);$i++){
        $post_id = $exceptions[$i];
        $index = array_search($post_id, $posts_ids);
        unset($posts_ids[$index]);
        echo 'post_id '.$post_id.' wasnt deleted at index '.$i.' of posts_ids';
        echo '<br>';
    }

    echo '<p>posts to erase:</p>';
    echo '<br>';
    print_r($posts_ids);
    echo '<br>';

    $counter = 0;
    foreach($posts_ids as $post_id){
        $user_id = lps_retrieve_user_ID($post_id);
        lps_delete_aspirante($post_id, $user_id);
        echo $counter.'th aspirante deleted';
        echo '<br>';
        $counter++;
    }
    // for($i=0;$i<sizeof($posts_ids);$i++){
    //     $post_id = $posts_ids[$i];
    //     $user_id = lps_retrieve_user_ID($post_id);
    //     lps_delete_aspirante($post_id, $user_id);
    //     echo $i.'th aspirante deleted';
    //     echo '<br>';
    // }
    
}

function lps_delete_alumnos($posts_ids){
    for($i=0;$i<sizeof($posts_ids);$i++){
        $post_id = $posts_ids[$i];
        wp_delete_post($post_id, true);
        echo $i.'th alumno deleted';
        echo '<br>';

    }
    
}

$exceptions = array(
    0 => 3493, //post_id noe esperon
    1 => 3492, //post_id vere carvajal
    2 => 3506, //post_id norma leticia
    3 => 3507, //post_id rosa maria barrera
    4 => 3508, //post_id maria concepcion barrera
    5 => 3509, //post_id andrea de la peña
    6 => 3510, //post_id larix sanchez
    7 => 3511, //post_id vianca lilian
    8 => 3512, //post_id mariana climent
    9 => 3513, //post_id rocio pelaez
);

lps_delete_aspirantes(lps_retrieve_posts_IDs('aspirantes'), $exceptions);
// lps_delete_alumnos(lps_retrieve_posts_IDs('alumnos'));
// lps_delete_aspirante(3327, 796);
















?>