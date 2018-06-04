<?php acf_form_head() ?>
<article id="single-post" class="white-popup mfp-with-anim post-<?php the_ID(); ?>">

<?php 	



$faq_category_input_args = array(
    'post_id'    	=>  get_the_ID(),
    'new_post'     => array(
        'post_type'    => 'faqs_certificadores',
        'post_status'  => 'publish'
    ),
    // 'field_groups' => array('1802'),
    'field_groups' => array('1775'),
    'submit_value' => __("Submit FAQ", 'bonestheme')
);

acf_form($faq_category_input_args);



?>

</article>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('select').material_select();
});
</script>
