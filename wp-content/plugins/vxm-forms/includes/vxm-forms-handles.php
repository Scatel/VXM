<?php



add_action('admin_post_vxm_forms_captura_alumnos', 'vxm_forms_captura_alumnos');
function vxm_forms_captura_alumnos(){

    $post_id = $_POST['post_id'];

    if($_POST['post_id'] === 'new_post'){
        // $args = array(...)
        // $post_id = wp_create_post($args);
        $post_id = 45;
    } else {
        $post_id = $_POST['post_id'];
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
        'num_instructor' => $_POST['num_instructor']  
    );

    if($_POST['post_id'] === 'new_post'){
        vxm_db_insert('aio_vxm_bda', $row);
    } else {
        // $bda_id = $vxm_get_id();
        vxm_db_update( $bda_id, 'aio_vxm_bda', $row);
    }

    // print_r($_POST);
    wp_redirect(get_the_permalink(92));
    exit;

}

?>