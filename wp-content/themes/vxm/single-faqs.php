
<?php acf_form_head(); ?>
<?php get_header(); ?>
<article id="single-post" class="post-<?php the_ID(); ?>">
    <div style="width: 1500px; padding: 200px; margin: auto;">
        <?php 	



        $faq_args = array(
            'post_id'    	=>  get_the_ID(),
            'new_post'     => array(
                'post_type'    => 'faqs',
                'post_status'  => 'publish'
            ),
            'return' => get_permalink(10),
            // 'field_groups' => array('group_5b0301a6c91b2'),
            'field_groups' => array(1735),
            'submit_value' => __("Submit FAQ", 'bonestheme')
        );

        acf_form($faq_args);



        ?>

    </div>

</article>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('textarea').css('height', '150')
    console.log($('.btn-flat'))
});
</script>

<?php get_footer(); ?>