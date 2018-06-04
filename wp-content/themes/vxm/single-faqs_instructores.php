<?php acf_form_head() ?>
<?php get_header() ?>
<article id="single-post" class="white-popup mfp-with-anim post-<?php the_ID(); ?>">

<?php 	



$faq_instructores_args = array(
    'post_id'    	=>  get_the_ID(),
    'new_post'     => array(
        'post_type'    => 'faqs_instructores',
        'post_status'  => 'publish'
    ),
    'field_groups' => array('1884'),
    'submit_value' => __("Submit FAQ", 'bonestheme')
);

acf_form($faq_instructores_args);



?>

</article>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('select').material_select();
});
</script>

<?php get_footer() ?>
