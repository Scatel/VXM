<?php



add_action('admin_post_vxm_forms_captura_alumnos', 'vxm_forms_captura_alumnos');
function vxm_forms_captura_alumnos(){

    $post_id = $_POST['post_id'];

    if($_POST['num_instructor'] == ''){
        $author_id = get_current_user_id();
    } else {
        $author_id = $_POST['num_instructor'];
    }




    $row = array(
        'post_id' => $post_id,
        'fecha_alta' => $_POST['fecha_alta'],
        'nombres' => strtoupper($_POST['nombres']),
        'apellidos' => strtoupper($_POST['apellidos']),
        'sexo' => $_POST['sexo'],
        'pais' => $_POST['pais'],
        'estado' => strtoupper($_POST['estado']),
        'municipio' => strtoupper($_POST['municipio']),
        'colonia' => strtoupper($_POST['colonia']),
        'calle' => strtoupper($_POST['calle']),
        'telefono1' => $_POST['telefono1'],
        'telefono2' => $_POST['telefono2'],
        'email' => $_POST['email'],
        'nombre_mama' => strtoupper($_POST['nombre_mama']),
        'num_instructor' => $author_id
    );

    if($_POST['post_id'] === 'new_post'){
        vxm_db_insert('aio_vxm_bda', $row);
    } else {
        vxm_db_update( $bda_id, 'aio_vxm_bda', $row);
    }


    if($_POST['post_id'] === 'new_post'){
        $email = $_POST['email'];
        $full_name = strtoupper($_POST['nombres']);
        $post_id =  insert_alumno_post($email, $full_name, $author_id);
    } 

    wp_redirect(get_the_permalink(92));
    exit;

}

function insert_alumno_post($email, $full_name, $author_id){
    // Create post object
    $my_post = array();

    // Create $my_post object
    $my_post['post_author'] = $author_id;
    $my_post['post_title'] = $full_name;
    $my_post['post_status'] = 'publish';
    $my_post['post_type'] = 'alumnos';
    $my_post['comment_status'] = 'closed';
    $my_post['ping_status'] = 'closed';

    // Insert the post into the database
    $post_id = wp_insert_post($my_post);

    $args = array(
        'guid' => 'http://localhost/vxm/?alumnos='.$post_id
    );
    wp_update_post( $args );

    // echo $post_id.',';
    return $post_id;
}



?>