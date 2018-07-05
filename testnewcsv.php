<?php


header('Content-Type: text/html; charset=UTF-8');
require('wp-load.php');
define('WP_USE_THEMES', true);

// print_r(parse_aspirante_infos());

$aspirante_infos =  parse_aspirante_infos();
insert_aspirantes($aspirante_infos);

function parse_aspirante_infos(){
    $aspirante_infos = array();
    echo '<br>';
    echo '<br>';
    // echo '14jun_info_aspirantes/14jun_aspirantes_faltantes_info1.csv';
    echo '<br>';
    echo '<br>';
    $CSVfp = fopen("14jun_info_aspirantes/14jun_aspirantes_faltantes_info15.csv", "r");
    if($CSVfp !== FALSE) {
        while(! feof($CSVfp)) {
            $data = fgetcsv($CSVfp, 1000, ",");
    
            $aspirante_info['primer_nombre'] = $data['0'];
            $aspirante_info['apellidos'] = $data['1'];
            $aspirante_info['pais'] = $data['2'];
            $aspirante_info['estado'] = $data['3'];
            $aspirante_info['municipio'] = $data['4'];
            $aspirante_info['colonia'] = $data['5'];
            $aspirante_info['telefono1'] = $data['6'];
            $aspirante_info['telefono2'] = $data['7'];
            $aspirante_info['email'] = $data['8'];
            $aspirante_info['niveo'] = $data['9'];
            $aspirante_info['status'] = $data['10'];
    
            array_push($aspirante_infos,$aspirante_info);
        }
    }
    fclose($CSVfp);
    return $aspirante_infos;
}



// post_id,user_id,email,password

function insert_aspirantes($aspirante_infos){
    for($i = 0; $i < sizeof($aspirante_infos); $i++){

        $email = $aspirante_infos[$i]['email'];
        $found = email_exists($email);

        echo $i.',';
        if($found == false || $found == 0){
            insert_aspirante($aspirante_infos[$i]);
            echo '<br>';
        } else if (gettype($found) == "integer" && $found != 0) {
            echo 'no_post,'.$found.','.$email.',no_password';
            echo '<br>';
        } else {
            echo 'unknown';
            echo '<br>';
        }
    }
    echo '<br>';
    echo '<br>';
}



function insert_aspirante($aspirante_info){

    $email = $aspirante_info['email'];
    $full_name = $aspirante_info['primer_nombre'].' '.$aspirante_info['apellidos'];
    $aspirante_meta = $aspirante_info;

    $post_id = insert_aspirante_post($email, $full_name);
    
    insert_aspirante_post_meta($post_id, $aspirante_meta);
    $password = insert_aspirante_user($post_id, $email, $aspirante_meta['status']);
    // update_field('status', $aspirante_meta['status'], 'user_'.$user_id);

}


// $aspirante_meta['primer_nombre'] = $aspirante_info['primer_nombre'];
// $aspirante_meta['apellidos'] = $aspirante_info['apellidos'];
// $aspirante_meta['pais'] = $aspirante_info['pais'];
// $aspirante_meta['estado'] = $aspirante_info['estado'];
// $aspirante_meta['municipio'] = $aspirante_info['municipio'];
// $aspirante_meta['colonia'] = $aspirante_info['colonia'];
// $aspirante_meta['telefono1'] = $aspirante_info['telefono1'];
// $aspirante_meta['telefono2'] = $aspirante_info['telefono2'];
// $aspirante_meta['email'] = $aspirante_info['email'];
// $aspirante_meta['niveo'] = $aspirante_info['niveo'];
// $aspirante_meta['status'] = $aspirante_info['status'];



function insert_aspirante_post($email, $full_name){
    // Create post object
    $my_post = array();

    // Create $my_post object
    $my_post['post_author'] = 713;
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

    echo $post_id.',';
    return $post_id;
}




function insert_aspirante_user($post_id, $email, $status){
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

        // update_post_meta( $post_id, '__status', 'field_5a8bdc3f3e036' );

    } 
    // update_field('status', $status, 'user_'.$user_id);
    if ( is_wp_error( $user_id ) ) {
        print_r($user_id);
        echo $user_id;
    } else {
        echo $user_id.','.$email.','.$password;
        return $password;
    }
    // echo $user_id.','.$email.','.$password;
    // return $password;
}


function insert_aspirante_post_meta($post_id, $aspirante_meta){

    


    $aspirante = array();

    $aspirante['first_name'] = $aspirante_meta['primer_nombre'];
    $aspirante['apellidos'] = $aspirante_meta['apellidos'];
    $aspirante['pagado'] = '';
    $aspirante['importe'] = '0';
    $aspirante['lugar_cert'] = 'NOINFO';
    $aspirante['pais'] = $aspirante_meta['pais'];
    $aspirante['edo'] = $aspirante_meta['estado']; 
    $aspirante['municipio'] = $aspirante_meta['municipio']; 
    $aspirante['colonia'] =  $aspirante_meta['colonia'];
    $aspirante['calle'] = '';
    $aspirante['telefono1'] = $aspirante_meta['telefono1'];
    $aspirante['telefono2'] = $aspirante_meta['telefono2'];
    $aspirante['email'] = $aspirante_meta['email'];
    $aspirante['niveo'] = $aspirante_meta['niveo'];
    $aspirante['notas'] = '';
    $aspirante['post_id'] = $post_id; //para el wp-old-slug;
    $aspirante['user_id'] = '';
    $aspirante['status'] = $aspirante_meta['status'];

    $meta_keys = array(
        'OFC-1-ANombresDelAspirante',   
        '_OFC-1-ANombresDelAspirante',   
        'OFC-1-AApellidosDelAspirante',  
        '_OFC-1-AApellidosDelAspirante',    
        'OFC-1-AYaPagoSuCertificacion',     
        '_OFC-1-AYaPagoSuCertificacion',      
        'OFC-1-AImporteQuePagoEnSuCertificación',     
        '_OFC-1-AImporteQuePagoEnSuCertificación',    
        'OFC-1-ALugarDeCertificacion',   
        '_OFC-1-ALugarDeCertificacion', 
        'OFI-1-APais',     
        '_OFI-1-APais',    
        'OFI-1-AEstado',   
        '_OFI-1-AEstado',     
        'OFI-1-AMunicipio',    
        '_OFI-1-AMunicipio',  
        'OFI-1-AColonia',     
        '_OFI-1-AColonia',    
        'OFI-1-ACalle',       
        '_OFI-1-ACalle',      
        'OFI-1-ATelefono1',    
        '_OFI-1-ATelefono1',    
        'OFI-1-ATelefono2',     
        '_OFI-1-ATelefono2',     
        'OFI-1-AEmail',        
        '_OFI-1-AEmail',        
        'numero_instructor_veo',   
        '_numero_instructor_veo',  
        'aspirante_admin_note',    
        '_aspirante_admin_note',    
        '_validate_email',          
        '__validate_email',         
        '_wp_old_slug',        
        'tipo_de_aspirante',        
        '_tipo_de_aspirante',           
        '_status',
        '__status',         
        '_userid' 
    );

    $meta_values = array(
        $aspirante['first_name'],
        'field_580832340ea65',
        $aspirante['apellidos'],
        'field_580832340eae0',
        $aspirante['pagado'],
        'field_580832340eb5e',
        $aspirante['importe'],
        'field_580832340ebdc',
        $aspirante['lugar_cert'],
        'field_58083c1b823fd',
        $aspirante['pais'],
        'field_5806e51f740dd',
        $aspirante['edo'],
        'field_5806ed35740de',
        $aspirante['municipio'],
        'field_5806edff740df',
        $aspirante['colonia'],
        'field_5806ef93740e0',
        $aspirante['calle'],
        'field_5806f0c2740e1',
        $aspirante['telefono1'],
        'field_5806f0f4740e2',
        $aspirante['telefono2'],
        'field_5806f12b740e3',
        $aspirante['email'],
        'field_5806f16d740e5',
        $aspirante['niveo'],
        'field_5a8b05f27f7c2',
        $aspirante['notas'],
        'field_5a8ddbe3c7094',
        '',
        '_validate_email',
        $aspirante['post_id'],
        'instructor',
        'field_580ee593ab24b',
        $aspirante['status'],
        'field_5a8bdc3f3e036',
        $aspirante['user_id']
    );
    for ($k = 0; $k <= sizeof($meta_values); $k++){
        add_post_meta( $post_id, $meta_keys[$k], $meta_values[$k] );
    }
}




