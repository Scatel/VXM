<?php



add_action('admin_post_vxm_forms_captura_alumnos', 'vxm_forms_captura_alumnos');
function vxm_forms_captura_alumnos(){

    $row = array(
        'post_id' => 1940,
        'fecha_alta' => $_POST['fecha_alta'],
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'sexo' => $_POST['sexo'],
        'pais' => $_POST['pais'],
        'estado' => $_POST['estado'],
        'municipio' => $_POST['municipio'],
        'colonia' => $_POST['colonia'],
        'calle' => $_POST['calle'],
        'telefono1' => $_POST['telefono1'],
        'telefono2' => $_POST['telefono2'],
        'email' => $_POST['email'],
        'nombre_mama' => $_POST['nombre_mama'],
        'num_instructor' => $_POST['num_instructor']  
    );

    vxm_db_insert('aio_vxm_bda', $row);

    wp_redirect(get_the_permalink(92));
    exit;

}

?>