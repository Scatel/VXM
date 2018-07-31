<?php

header('Content-Type: text/html; charset=UTF-8'); 
require('../../wp-load.php');
define('WP_USE_THEMES', true);


function insert_certificador_user($post_id, $email, $status){
    $password = wp_generate_password( 12, false );
    $user_id = wp_create_user($email,$password,$email);
    
    if(gettype($user_id) == "integer"){
        wp_update_user(
            array(
                'ID'          =>    $user_id,
                'nickname'    =>    $email
            )
        );
        $user = new WP_User( $user_id );
        $user->set_role( 'subscriber' );
        update_post_meta( $post_id, '_userid', $user_id );
        update_field('status', $status, 'user_'.$user_id);
    } 

    if ( is_wp_error( $user_id ) ) {
        print_r($user_id);
        echo $user_id;
    } else {
        echo $user_id.','.$email.','.$password;
        return $password;
    }
}




$args = array(
    'ASP_nombre_completo' => 'GERARDO MIJARES',
    'ASP_colonia' => 'VALLE PRIMAVERA'
);

insert_certificador_field_values(3396, $args);

function insert_certificador_field_values($post_id, $certificador_values){
    // if(sizeof($certificador_meta) === sizeof($certificador_fields)){
        $fields = array_keys($certificador_values);

        $aspirante_values = array();

        for($i = 0; $i < sizeof($fields); $i++){
            $field = $fields[$i];
            update_field($field, $certificador_values[$field]);
        }

        // $certificador_keys = array_keys($certificador_values);

        // for ($k = 0; $k <= sizeof($certificador_keys); $k++){
        //     $key = $certificador_keys[$k];
        //     add_post_meta($post_id, $key, $certificador_values[$key]);
        // }
        
        add_post_meta($post_id, '_validate_email', '');
        add_post_meta($post_id, '__validate_email', '_validate_email');
        add_post_meta($post_id, 'pass_changed', 'not_changed');
        add_post_meta($post_id, 'ASP_tipo_aspirante', 'instructor');
        add_post_meta($post_id, '_ASP_tipo_aspirante', 'field_580ee593ab24b');

    // }
}
