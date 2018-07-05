<?php
/*
Template Name: OFI-3
*/
acf_form_head();
$num_alumno = $_GET['num_alumno'];
// here you should retreive a bunch of data of the student from a custom database table

$args = array(
    'num_alumno' => 1800,
    'num_imagen' => 2
);

$row = lps_select_one('descripcion_imagen, simboliza', 'aio_vxm_bdrei', $args);



$args = array(
    'post_id'      => 'new_post',
    'new_post'     => array(
        'post_type'    => 'aspirantes',
        'post_status'  => 'publish'
    ),
    'field_groups' => array('group_58083233c61be'),
    'html_before_fields' => '<div class="grid-bottom">',
    'html_after_fields' => '</div>',
    // 'return' =>  get_the_permalink($_GET['redirect_id']),
    'updated_message' => __("Post updated", 'acf'),
    'submit_value' => __("Grabar Cambios", 'bonestheme')
);


?>







	<article id="single-post" class="white-popup mfp-with-anim post-<?php the_ID(); ?>">

        <?php vxm_forms_alumnos(); ?>


        <?php while (have_posts()) : the_post(); ?>


        <h2 class="h6 no-margin">Registrar costos de clase</h2>


        <script>
        $( function() {
            $( ".datepicker" ).datepicker();
        } );
        </script>
        <div class="acf-date-picker acf-input-wrap" data-date_format="dd/mm/yy" data-first_day="1">
            <input class="datepicker" type="text" >
        </div>






        <div class="section"><div class="divider"></div></div>





        <!-- <div class="container"> -->
            <?php echo do_shortcode('[hf_form slug="ofi-3"]'); ?>
        <!-- </div> -->
        <footer>
        </footer>

        <?php endwhile;?>

</article>






