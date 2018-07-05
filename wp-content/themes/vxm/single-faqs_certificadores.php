<?php acf_form_head() ?>
<?php get_header() ?>
<article id="single-post" class="post-<?php the_ID(); ?>">

<div style="width: 1500px; padding: 200px; margin: auto;">
    <?php
    $faq_certificadores_args = array(
        'post_id'    	=>  get_the_ID(),
        'new_post'     => array(
            'post_type'    => 'faqs_certificadores',
            'post_status'  => 'publish'
        ),
        'return' => get_permalink(125),
        'field_groups' => array('1789'),
        'submit_value' => __("Submit FAQ", 'bonestheme')
    );
    acf_form($faq_certificadores_args);
    ?>
</div>

</article>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('select').material_select();
});
</script>

<?php get_footer() ?>