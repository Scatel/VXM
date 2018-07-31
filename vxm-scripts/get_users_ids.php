<?php


header('Content-Type: text/html; charset=UTF-8'); 
require('../wp-load.php');
require_once(ABSPATH.'/wp-admin/includes/user.php');

define('WP_USE_THEMES', true);





$posts_ids = array(
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

for($i = 0; $i < sizeof($posts_ids); $i++){
    $post_id = $posts_ids[$i];
    $user_id = get_post_meta($post_id, '_userid', true);
    echo $post_id.','.$user_id;
    echo '<br>';
}