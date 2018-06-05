<?php/*
Template Name: Reset Password
*/
?>
<?php if (!is_user_logged_in()) auth_redirect(); ?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php $user = wp_get_current_user(); $userid = $user->ID; ?>

<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <form action="<?php echo get_site_url(); ?>/wp-admin/admist-post.php" method="POST">

        <input type="hidden" name="action" value="reset_password">

        Nueva contraseña:
        <br>
        <input type="text" name="pass_1">
        <br>
        Ingresar de nuevo:
        <br>
        <input type="text" name="pass_2">
        <br><br>
        <input type="submit" value="Submit">
    </form>

</main>


<?php get_footer(); ?>