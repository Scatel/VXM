<?php
function vxm_forms_email_exists($email){
    
    $email = lps_select_one('email, post_id', 'aio_vxm_bda', array('email'=>$email));

    // return $email;
    if(gettype($result) == 'NULL'){
        return false;
    } else {
        return $email['post_id'];
    }


}
?>