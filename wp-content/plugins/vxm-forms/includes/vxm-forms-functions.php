<?php

require_once plugin_dir_path(__FILE__).'vxm-forms-alumnos.php';
require_once plugin_dir_path(__FILE__).'vxm-forms-handles.php';
require_once plugin_dir_path(__FILE__).'vxm-forms-validations.php';


// load vxm_forms_handles after plugins are loaded since it depends on some of em
add_action('plugins_loaded', 'vxm_forms_init');
function vxm_forms_init(){
    do_action('vxm_forms_handles');
}




?>