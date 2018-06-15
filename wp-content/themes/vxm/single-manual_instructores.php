<?php acf_form_head() ?>
<?php get_header() ?>
<article id="single-post" class="post-<?php the_ID(); ?>">
    <div style="width: 1500px; padding: 200px; margin: auto;">
        <?php 	
        $entry_instructores_args = array(
            'post_id'    	=>  get_the_ID(),
            'new_post'     => array(
                'post_type'    => 'manual_instructores',
                'post_status'  => 'publish'
            ),
            'return' => get_permalink(92),
            'field_groups' => array('1781'),
            'submit_value' => __("Submit FAQ", 'bonestheme')
        );
        acf_form($entry_instructores_args);
        ?>
    </div>
</article>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('select').material_select();
});
</script>

<?php get_footer() ?>
