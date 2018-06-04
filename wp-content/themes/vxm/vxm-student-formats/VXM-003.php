<?php

    $args = array( 'numberposts' => '1', 'post_type'=>'alumnos');
    $recent_posts = wp_get_recent_posts( $args );

    $student = reset($recent_posts);
    $studentmeta = get_post_meta($student["ID"]);

?>
<style>
    .container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }

    table, th, td {
        border: 1px solid black;
    }
</style>

<h1>LOOK AT ME IM MR MEESEKS</h1>
    
<div class="container" id="printJS-format">
    <h1><?php $student["post_title"]?></h1>
    <table >
        <tr>
            <th>SESION</th>
            <th>FECHA</th>
            <th>DESCRIPCION DEL AVANCE</th>
            <th>FIRMA DEL PADRE/MADRE</th>
        </tr>

    <?php
        for ($i = 1; $i <= 10; $i++) {
            echo '
            <tr>
                <td>'.$i.'</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            ';
        }         
    ?>

    </table>
</div>  


