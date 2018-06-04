<?php get_header() ?>
<?php acf_form_head() ?>
<article id="single-post" class="white-popup mfp-with-anim post-<?php the_ID(); ?>">

<?php 	



$faq_certificadores_args = array(
    'post_id'    	=>  get_the_ID(),
    'new_post'     => array(
        'post_type'    => 'faqs_certificadores',
        'post_status'  => 'publish'
    ),
    'field_groups' => array('1901'),
    'submit_value' => __("Submit FAQ", 'bonestheme')
);

acf_form($faq_certificadores_args);



?>

</article>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('select').material_select();
});
</script>

<?php get_footer() ?>