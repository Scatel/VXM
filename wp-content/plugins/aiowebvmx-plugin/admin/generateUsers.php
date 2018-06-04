<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
include_once(ABSPATH  . '/wp-config.php');
include_once(ABSPATH  . '/wp-load.php');
include_once(ABSPATH . '/wp-includes/wp-db.php');


class generateUsers {
   
    var $i = 0;
    var $nombreUsuario = '';
    var $pass = '';
    var $lastId = 0;
    var $passusr = '';
   
    function usersMetaInsert($id,$nombre){
        global $wpdb;
        //$user_meta = array(user_id => $id,
        //    meta_key => 'first_name',
        //    meta_value => '');
      //  $wpdb->insert($wpdb->prefix . 'usermeta', $user_meta);          
    }
    
    function generateRandomString($length = 10) {

    }   
    
    function canti($cant = 50,$event='') {
        
    }
    
    function deleteUserByEvent($eventId)
    {
        
    }
}
?>