<?php 
function lps_select_one($column, $table, $where){
    global $wpdb;

    $keys = array_keys($where);
    $where_query = '';
    for($i = 0; $i < sizeof($keys) - 1; $i++){
        $where_query = $where_query.$keys[$i].' = '.$where[$keys[$i]].' AND ';
    }
    $where_query = $where_query.$keys[$i].' = '.$where[$keys[$i]].';';

    $row = $wpdb->get_row("SELECT ".$column." FROM ".$table." WHERE ".$where_query, 'ARRAY_A');

    if(sizeof($row) == 1){
        return $row[$column];
    } else {
        return $row;   
    }
}

function vxm_db_insert($table, $row){
    global $wpdb;
    $wpdb->insert($table, $row);
}

function lps_insert_bdrei($column, $row){
    global $wpdb;
    $wpdb->insert("wp_submitted_form", array(
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "country" => $country,
        "course" => $course,
        "message" => $message,
        "datesent" => $now
    ));
}

function lps_update_bdrei($column, $registro_id, $row){
    global $wpdb;
    $wpdb->insert("wp_submitted_form", array(
    "name" => $name,
    "email" => $email,
    "phone" => $phone,
    "country" => $country,
    "course" => $course,
    "message" => $message,
    "datesent" => $now ,
    ));
}





