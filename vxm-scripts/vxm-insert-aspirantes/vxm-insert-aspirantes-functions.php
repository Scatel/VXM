<?php 

function insert_aspirante_post_meta($post_id, $aspirante_meta, $tipo_aspirante){

    $keys = array_keys($aspirante_meta);

    for($i = 0; $i < sizeof($keys); $i++){
        $key = $keys[$i];
        $value = $aspirante_meta[$key];
        update_field($key, $value, $post_id);
    }

    // echo 'aspirante meta with post_id '.$post_id.' inserted';
    // br();

    update_field('ASP_tipo_aspirante', $tipo_aspirante, $post_id);

    update_post_meta($post_id, '_validate_email', '');
    update_post_meta($post_id, '__validate_email', '_validate_email');
    update_post_meta($post_id, 'pass_changed', 'not_changed');

}

function insert_aspirante_post($full_name, $author_user_id){
// Create post object
$my_post = array();

// Create $my_post object
$my_post['post_author'] = $author_user_id;
$my_post['post_title'] = $full_name;
$my_post['post_status'] = 'publish';
$my_post['post_type'] = 'aspirantes';
$my_post['comment_status'] = 'closed';
$my_post['ping_status'] = 'closed';
$my_post['guid'] = 'http://localhost/vxm/?aspirantes=';

// Insert the post into the database
$post_id = wp_insert_post($my_post); 

$args = array(
    'guid' => 'http://localhost/vxm/?aspirantes='.$post_id
);
wp_update_post( $args );

return $post_id;
}

function insert_aspirante_user($post_id, $email, $password, $status){

$user_id = 'ERROR: email exists already';

$exists = email_exists($email);

if($exists === false){
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
}


if (  $user_id === 'ERROR: email exists already' ) {
    // print_r($user_id);
    echo 'ERROR: email exists already //,'.$email;
    wp_delete_post($post_id);
    // print_r(get_error_message($user_id));
    br();
} else {
    echo $user_id.','.$post_id.','.$email.','.$password;
    br();
    return $user_id;
}
}

function insert_aspirante($aspirante_meta, $tipo_aspirante){

$email = $aspirante_meta['ASP_email'];
$full_name = $aspirante_meta['ASP_nombre_completo'];
$password = $aspirante_meta['ASP_initial_pass'];
$status =  $aspirante_meta['_status'];
$author_user_id = $aspirante_meta['author_id'];

$author_key_index = array_search('author_id', $aspirante_meta);
unset($aspirante_meta[$author_key_index]);


if(strpos($email, '@') !== false){
    // these functions will echo information about created aspirante
    $post_id = insert_aspirante_post($full_name, $author_user_id);
    insert_aspirante_post_meta($post_id, $aspirante_meta, $tipo_aspirante);
    insert_aspirante_user($post_id, $email, $password, $status);
} else {
    echo 'ERROR: empty email //,'.$full_name;
    br();
}



}

function insert_aspirantes($aspirante_metas, $tipo_aspirante){
for($i = 0; $i < sizeof($aspirante_metas); $i++){
    echo $i.',';
    $aspirante_meta = $aspirante_metas[$i];
    // $author_user_id = $aspirante_meta['author_id']
    insert_aspirante($aspirante_meta, $tipo_aspirante);
}
}


function insert_aspirante_with_user($aspirante_meta, $tipo_aspirante, $user_id){

    $email = $aspirante_meta['ASP_email'];
    $full_name = $aspirante_meta['ASP_nombre_completo'];
    $password = $aspirante_meta['ASP_initial_pass'];
    $status =  $aspirante_meta['_status'];
    
    if(strpos($email, '@') !== false){
        // these functions will echo information about created aspirante
        $post_id = insert_aspirante_post($full_name, 713);
        insert_aspirante_post_meta($post_id, $aspirante_meta, $tipo_aspirante);
        update_post_meta( $post_id, '_userid', $user_id );
        update_field('status', $status, 'user_'.$user_id);
        echo $user_id.','.$post_id.','.$email.','.$password;
    } else {
        echo 'ERROR: empty email //,'.$full_name;
        br();
    }
    
    
    
    }
    



function br(){
echo '<br>';
}

