<?php

require_once plugin_dir_path(__FILE__).'vxm-forms-alumnos.php';
require_once plugin_dir_path(__FILE__).'vxm-forms-handles.php';

add_action('plugins_loaded', 'vxm_forms_init');
function vxm_forms_init(){
    do_action('vxm_forms_handles');
}


?>