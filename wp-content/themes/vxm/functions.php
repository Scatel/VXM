<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/







// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );

// COMPRESSION
//require_once( 'library/compression.php' );

// EXTRAS
require_once( 'library/extras.php' );

// CUSTOM PLUGINS
//require_once( 'library/plugins.php' );

// THEME OPTION CUSTOMIZER
//require_once( 'library/customizer.php' );

// AIO CUSTOM FUNCTIONS
require_once( 'library/customs.php' );

// AIO CUSTOM POST STATUSES
//require_once( 'library/custom-post-status.php' );

// DEVICE BODY CLASS
require_once( 'library/device-body-class/devicebodyclass.php' );

// WP ADVANCED SEARCH (http://wpadvancedsearch.com/docs/setup/)
//require_once('wp-advanced-search/wpas.php');

// WPAS Forms
//require_once('library/wpas-forms.php');

// ACF Fields Groups
// require_once('library/acf-fields.php');




/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
//add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
//add_image_size( 'slider', 1050, 317, true );
add_image_size( 'gallery-thumb-360', 360, 235, true );
add_image_size( 'gallery-thumb-150', 150, 98, true );
add_image_size( 'gallery-full-1200', 1200, 1200, false );


/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        //'bones-thumb-600' => __('600px by 150px'),
        //'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  $wp_customize->remove_section('colors');
  $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/**
 * Replacing the default WordPress search form with an HTML5 version
 *
 */
function html5_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="cf" action="' . home_url( '/' ) . '" >
    <label class="assistive-text" for="s">' . __('Search for:') . '</label>
    <input type="search" placeholder="Palabra clave" value="' . get_search_query() . '" name="s" id="s" />
    <input type="hidden" name="post_type" value="places" />
    <span class="search-icon"><i class="icon-search"></i></span>
    <input type="submit" id="searchsubmit" value="Buscar" />
    </form>';

    return $form;
}
//add_filter( 'get_search_form', 'html5_search_form' );




function wp_edit_post_link($link = 'Edit Post')

{

  global $post;

  // echo  $post->post_type ;
  if ( $post->post_type == 'page' ) {

    if ( !current_user_can( 'edit_page', $post->ID ) )

    return;

  } else {

    if ( !current_user_can( 'edit_post', $post->ID ) )

    return;

  }

  $link = "<a class='lps-edit' href='" . get_permalink( $post->ID) . "'>".$link."</a>";
  echo $link;
  
}


function wp_delete_post_link($link = 'Delete Post')

{

  global $post;

  // echo  $post->post_type ;
  if ( $post->post_type == 'page' ) {

    if ( !current_user_can( 'edit_page', $post->ID ) )

    return;

  } else {

    if ( !current_user_can( 'edit_post', $post->ID ) )

    return;

  }

  $link = "<a class='lps-delete small' href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&amp;post=" . $post->ID, 'delete-post_' . $post->ID) . "'>".$link."</a>";
  echo $link;
  
}


add_action('init','wp_delete_faq_category');
function wp_delete_faq_category(){
  if(isset($_REQUEST['action']) && $_REQUEST['action']=='wp_delete_faq_category') {
    // require_once(ABSPATH.'wp-admin/includes/user.php');
    //check admin permissions.


    $post_id = intval($_REQUEST['post_id']);
    if (current_user_can('edit_post', $post_id)) {


        wp_delete_post($post_id, true); 

        // retrieve link from url
        if(isset($_REQUEST['redirect_id'])){
          wp_redirect(get_permalink($_REQUEST['redirect_id']));
        } else {
          wp_redirect(92);
        }
        exit();
    }
  }
  
}


function wp_delete_faq_category_link($link = 'Delete Post', $post_id, $red_id = 2)

{

  $post = get_post($post_id);

  // echo  $post->post_type ;
  if ( $post->post_type == 'page' ) {

    if ( !current_user_can( 'edit_page', $post->ID ) )

    return;

  } else {

    if ( !current_user_can( 'edit_post', $post->ID ) )

    return;

  }


  // $red_id = 10;
  $link = "<a class='lps-delete small' href='" . wp_nonce_url( get_bloginfo('url') ). "/?page_id=10&action=wp_delete_faq_category&post_id=".$post->ID."&redirect_id=".$red_id."'>".$link."</a>";
  echo $link;
  
}


add_action('init','wp_delete_aspirante');
function wp_delete_aspirante() {
  if(isset($_REQUEST['action']) && $_REQUEST['action']=='wp_delete_aspirante') {
    require_once(ABSPATH.'wp-admin/includes/user.php');
    //check admin permissions.
    if (current_user_can('edit_users')) {
        $user_id = intval($_REQUEST['user_id']);
        $post_id = intval($_REQUEST['post_id']);


        update_field('status', 50, 'user_'.$user_id);
        update_field('_status', 50, $post_id);

        // retrieve link from url
        if(isset($_REQUEST['redirect_id'])){
          wp_redirect(get_permalink($_REQUEST['redirect_id']));
        } else {
          wp_redirect(get_permalink(92));
        }
        
        exit();
    }
  }
}

function wp_delete_aspirante_link($userID, $indiscriminate='', $redirect_id = '', $link = 'Delete User')
{
  global $post;
  $status = get_field('status', 'user_'.$userID);
  $url = add_query_arg(array('action'=>'wp_delete_aspirante', 'post_id'=>$post->ID, 'user_id'=>$userID));

  if($redirect_id !== ''){
    $url = $url.'&redirect_id='.$redirect_id;
  }

  if (current_user_can( 'delete_users', $userID )){
    if($indiscriminate == ''){
      echo  "<a class='lps-delete small' href='".$url."'>".$link."</a>"; 
    } elseif ($indiscriminate == $status){
      echo  "<a class='lps-delete small' href='".$url."'>".$link."</a>"; 
    }
  }


}










function create_format(){



  
  // Currently selecting the latest created student, problems might arise with this approach.
  $args = array( 'numberposts' => '1', 'post_type'=>'alumnos');
  $student = reset(wp_get_recent_posts( $args ));
  $studentmeta = get_post_meta($student["ID"]);

  // Start buffering html code
  ob_start();

  // Generate html code of the formats
  formats_VXM($student);

  file_put_contents('assets/VXM-formats-in-html/VXM-003.html', ob_get_contents());
  // end buffering and dont display in view
  ob_end_clean();
  // ob_end_flush();

  include_once (ABSPATH .'testpdf.php');
  printtest();


}


function formats_VXM($student = 'none'){

    $full_name = $student['post_title'];

  ?>
 <html>
    <head>
       <style>
        *, *:before, *:after { box-sizing: inherit; }
        </style>
        <!-- <link rel="stylesheet" href="test.css"> -->
        <style type="text/css" >p {color: black; font-size: 0.9em;}</style>
        <style>
    /* *{ font-family: DejaVu Sans !important;} */
  </style>
    </head>
    <body>  
  
    <div class="page" style="font-family:DejaVu Sans, sans-serif; page-break-after:always; box-sizing:border-box;">
        <header style="box-sizing:inherit; width: 100%;">
            <div class="format-id" style="width:100%; text-align:right; margin: 50px 20px 20px 0; font-weight:500; box-sizing:inherit;">F-VXM-001</div>
            <div class="logo" style="width: 27%; float:left; margin-top: 20px;"><img src="<?php echo ABSPATH ?>/assets/VXM-formats-in-html/vxm-logo.PNG" alt="vxm logo" style="display:block; width:100%; box-sizing:inherit;"></div>
            <div class="title" style="width:45%; text-align:center; padding: 30px; float:left; box-sizing:inherit;"><h5 style="box-sizing:inherit;">AVISO DE PRIVACIDAD</h5></div>
            <div class="deco" style="width: 20%; float:left; box-sizing:inherit; visibility:hidden;"><img src="<?php echo ABSPATH ?>/assets/VXM-formats-in-html/dummy.png" alt="dummy image" style="display:block; width:100%; box-sizing:inherit;"></div>
        </header>
        <section class="format_content" style="width:100%; display:block;">
        <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>

            Viendo por el Mundo con domicilio en Cerro San Elías 1014, Col. Las Puentes 9º Sector, San Nicolás de los Garza, Nuevo León, México es el responsable del uso y protección de sus datos personales, en términos de lo establecido por la Ley Federal de Protección de Datos Personales en Posesión de Particulares y al respecto le informa lo siguiente: 
        </p>
        <p>
            Los datos personales que recabamos de usted, los utilizaremos para las siguientes finalidades que son necesarias para el servicio que solicita:        
        </p>

        <ol >
            <li>
                Proveer los servicios de capacitación, impartición de cursos y enseñanza en general de cualquier tema relacionado con el Desarrollo personal. 
            </li>
            <li>
                Ofrecer información, servicios y promociones diseñados por Viendo por el Mundo para sus clientes.
            </li>
            <li>
                Para enviarle toda la información referente a los cursos, clases y sesiones que Viendo por el Mundo pone a su disposición para su conocimiento.
            </li>
            <li>
                Confirmar y corregir la información proporcionada con la que contamos, con la finalidad de garantizar la mejor calidad de nuestros servicios.
            </li>
            <li>
                Para brindarle servicios de atención a nuestros clientes, aclaración de dudas relacionados con la prestación de nuestros servicios.
            </li>

        </ol>

        <p>
            En caso de que no desee que sus datos personales se utilicen para estos fines, indíquelo a continuación: 
        </p>
        <p>
            Consiento que mis datos personales se utilicen para los fines antes mencionados: 
        </p>
        <p>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            SI______________
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            NO______________
        </p>
        <p>
            La negativa para el uso de sus datos personales para estas finalidades no podrá ser un motivo para que le neguemos los servicios y productos que solicita o contrata con nosotros.
        </p>




        </section>
    </div>  



    <div class="page" style="font-family:DejaVu Sans, sans-serif; page-break-after:always; box-sizing:border-box;">
      <header style="box-sizing:inherit; width: 100%;">
        <div class="format-id" style="width:100%; text-align:right; margin: 50px 20px 20px 0; font-weight:500; box-sizing:inherit;">F-VXM-003</div>
        <div class="logo" style="width: 27%; float:left; margin-top: 20px;"><img src="<?php echo ABSPATH ?>/assets/VXM-formats-in-html/vxm-logo.PNG" alt="vxm logo" style="display:block; width:100%; box-sizing:inherit;"></div>
        <div class="title" style="width:45%; text-align:center; padding: 30px; float:left; box-sizing:inherit;"><h5 style="box-sizing:inherit;">TESTIMONIOS DE LOS PADRES SOBRE AVANCES DE SU HIJO</h5></div>
        <div class="deco" style="width: 20%; float:left; box-sizing:inherit;"><img src="<?php echo ABSPATH ?>/assets/VXM-formats-in-html/dummy.png" alt="dummy image" style="display:block; width:100%; box-sizing:inherit;"></div>
      </header>
        <section class="format_content" style="width:100%; display:block;">


          <span style="display:block; width:600px; border-bottom: 1px solid black; font-weight:700; margin-bottom: 20px;">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NOMBRE DEL ALUMNO:
            <?php echo $full_name; ?>
          </span>
        
        <table cellspacing=0 style="width: 100%; border: 1px solid black;">
            <tr style="font-size: 0.7em; text-align: center;">
                <th style="border: 1px solid black; width:7%; ">SESIÓN</th>
                <th style="border: 1px solid black; width:13%;">FECHA</th>
                <th style="border: 1px solid black; width:60%;">DESCRIPCIÓN DEL AVANCE</th>
                <th style="border: 1px solid black; width:20%;">FIRMA DEL PADRE/MADRE</th>
            </tr>
        
                <tr style="text-align: center;">
                    <td style="border: 1px solid black; height:50px;">1</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">2</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">3</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">4</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">5</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">6</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">7</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">8</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">9</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                
                <tr style="height: 70px; text-align: center;">
                    <td style="border: 1px solid black; height:50px;">10</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                </tr>
            </table>
      </section>
    </div>  

    <div class="page" style="font-family:DejaVu Sans, sans-serif; page-break-after:always; box-sizing:border-box;">
                <header style="box-sizing:inherit; width: 100%;">
                  <div class="format-id" style="width:100%; text-align:right; margin: 50px 20px 20px 0; font-weight:500; box-sizing:inherit;">F-VXM-004</div>
                  <div class="logo" style="width: 27%; float:left; margin-top: 20px;"><img src="<?php echo ABSPATH ?>/assets/VXM-formats-in-html/vxm-logo.PNG" alt="vxm logo" style="display:block; width:100%; box-sizing:inherit;"></div>
                  <div class="title" style="width:45%; text-align:center; padding: 30px; float:left; box-sizing:inherit;"><h5 style="box-sizing:inherit;">TESTIMONIOS DE LOS PADRES SOBRE AVANCES DE SU HIJO</h5></div>
                  <div class="deco" style="width: 20%; float:left; box-sizing:inherit;"><img src="<?php echo ABSPATH ?>/assets/VXM-formats-in-html/dummy.png" alt="dummy image" style="display:block; width:100%; box-sizing:inherit;"></div>
                </header>
                  <section class="format_content" style="width:100%;display:block;">

                    <p class="date" style=" width:100%; text-align:right; display:block; margin-top: 50px;">
                         <span style="width: 300px;"> Fecha:_________________________________________________</span>
                    </p>

                    <h5>
                        DATOS DEL ALUMNO:
                    </h5>
                    <p>
                        Indique con una "x", qué curso tomará su hijo:
                    </p>

                    <ul style="list-style-type: none;">
                        <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Curso VEO 1</li>
                        <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Curso VEO 2</li>
                        <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Curso VEO 3</li>
                        <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Curso VEO 4</li>
                        <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Curso VEO ___</li>
                    </ul>

                    <p>
                        Nombre del alumno
                        <span style="width: 680px; display:inline-block; border-bottom: 1px solid black; font-weight:700;">:</span>
                    </p>
                    <p>
                        Edad: <span style="width: 60px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                        Grado escolar: <span style="width: 60px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                        Fecha de nacimiento: <span style="width: 200px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                    </p>
                    <p>
                        Sexo: <span style="width: 200px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                    </p>
                    <p>
                        Nombre del padre: 
                        <span style="width: 650px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                    </p>
                    <p>
                        Nombre de la madre: 
                        <span style="width: 650px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                    </p>
                    <p>
                        Dirección: 
                        <span style="width: 650px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                    </p>
                    <p>
                        Teléfono: <span style="width: 250px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span> 
                        Celular: <span style="width: 250px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                    </p>

                </section>
              </div>  


    <div class="page" style="font-family:DejaVu Sans, sans-serif; page-break-after:always; box-sizing:border-box;">
                    <section class="format_content" style="width:100%;display:block;">
                    <p>
                        Correo electrónico: <span style="width: 650px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                    </p>
                    <p>
                        ¿Algun hermano ha tomado este curso anteriomente? <span style="width: 500px; display:inline-block; border-bottom: 1px solid black; font-weight:700;"></span>
                    </p>
                        <p>
                            ¿Por qué desea que su hijo tome el curso? (marque con una "X"):
                        </p>

                        <ul style="list-style-type: none;">
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene autismo</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene síndrome de Down</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene deficiencia mental</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene problemas de lecto-escritura</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene problemas de lenguaje</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene problemas de matemáticas</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene problemas de aprendizaje o bajo rendimiento escolar</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene baja autoestima o es inseguro</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene mala conducta</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene miedo porque dice ver fantasmas</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene traumas mentales</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene dislexia</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Tiene problemas para dormir</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Se orina en la cama</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Es débil visual</li>
                            <li><div style="height:13px; width:13px; border: 1px solid black; display:inline-block; margin-right:15px;"></div>Es invidente</li>
                            <li><div style="height:13px; width:13px;  display:inline-block; margin-right:15px;"></div>Otros:________________________________________________________________________</li>
                            <li style="margin-top:30px;"><div style="height:13px; width:13px;  display:inline-block; margin-right:15px;"></div>______________________________________________________________________________</li>

                        </ul>
                        <h5>INFORMACIÓN GENERAL</h5>
                        <p>
                            ¿Está su hijo(a) actualmente bajo algún tratamiento médico?
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 40px;">________________________________________________________________________________________</span>
                        </p>
                        <p>
                            ¿Tiene problemas alimenticios?
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 40px;">________________________________________________________________________________________</span>
                        </p>
                        <br>
                        <br>
                        <br>
                        <p>Defina el estado de salud física actual de su hijo(a):</p>
                        <p>
                            EXCELENTE: <span style=" display:inline-block; font-weight:700;">__________</span>
                            BUENO: <span style=" display:inline-block; font-weight:700; ">__________</span>
                            REGULAR: <span style=" display:inline-block; font-weight:700;">__________</span>
                            MALO: <span style=" display:inline-block; font-weight:700;">__________</span>
                        </p>
                        <p>Defina el estado de salud mental actual de su hijo(a):</p>
                        <p>
                            EXCELENTE: <span style="display:inline-block; font-weight:700;">__________</span>
                            BUENO: <span style="display:inline-block; font-weight:700; ">__________</span>
                            REGULAR: <span style="display:inline-block; font-weight:700;">__________</span>
                            MALO: <span style="display:inline-block; font-weight:700;">__________</span>
                        </p>
                        <p>
                            ¿Cómo se enteró de las clases de Visión Extra Ocular?
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 40px;">______________________________________________________________________________________________</span>
                        </p>
                    </section>
                </div>  

                <div class="page" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif; page-break-after:always; box-sizing:border-box;">
                    <section class="format_content" style="width:100%;">
                        
                        <h3 style="margin-top: 100px; margin-bottom: 100px;">EXENCIÓN DE RESPONSABILIDAD MÉDICA Y PSICOLÓGICA</h3>
                        
                        <p>El desarrollo proporcionado en este espacio o bajo el nombre de "Developing your Mind" <strong style="text-decoration: underline">NO</strong> puede en ningún modo sustituir la opinión de un profesional médico o psicológico (Médico, Psiquiatra, Psicólogo, u otros).<strong style="text-decoration: underline">No</strong> deberá en ningún modo ser interpretada como un intento de ofrecer un consejo médico, diagnóstico o tratamiento, que pudiera interferir en la práctica médica, psiquiátrica, o psicológica.</p>
                        <p>Entiendo y me doy por informado(a) de manera clara que el desarrollo proporcionado por "Developing Your Mind", <strong style="text-decoration: underline">NO</strong> es proporcionado por un profesional de medicina o psicología. El desarrollo mental en "Developing your Mind" deberá ser tomado como una Técina Alternativa para el desarrollo humano y mental. Por lo que cualquier resultado en aplicación de dicha técnica será completa responsabilidad de quien lo toma.</p>
                    
                        <p style="margin-top: 60px;">
                            Nombre del Padre/Madre o Tutor:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">_____________________________________________________________________________________________</span>
                        </p>
                        <p style="margin-top: 60px;">
                            Firma de enterado:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">_____________________________________________________________________________________________</span>
                        </p>
                        <p style="margin-top: 60px;">
                            Fecha:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">________________________________________________________</span>
                        </p>
                    </section>
                </div>  

                <div class="page" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif; page-break-after:always; box-sizing:border-box;">
                    <section class="format_content" style="width:100%;">
                        
                        <h3 style="margin-top: 100px; margin-bottom: 100px;">AUTORIZACIÓN</h3>
                        
                        <p>Doy mi permiso para que mi hijo(a) participe en actividades en relación con el curso de desarrollo mental, de 10 sesiones semanales a cargo de los instructores capacitados de "Developing your Mind" en sus instalaciones.</p>
                        <p>Entiendo que mi participación en el seguimiento de las tareas en casa son una parte importante del proceso de desarrollo mental, y por lo tanto, estoy de acuerdo en participar y seguir en su totalidad las recomendaciones dadas por los instructores en cada sesión semanal para optimizar los resultados en el proceso de desarrollo de mi hijo (a)</p>
                    
                        <p style="margin-top: 60px;">
                            Nombre del Padre/Madre o Tutor:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">_____________________________________________________________________________________________</span>
                        </p>
                        <p style="margin-top: 60px;">
                            Firma de enterado:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">_____________________________________________________________________________________________</span>
                        </p>
                        <p style="margin-top: 60px;">
                            Fecha:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">________________________________________________________</span>
                        </p>
                    </section>
                </div>  

                <div class="page" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif; page-break-after:always; box-sizing:border-box;">
                    <section class="format_content" style="width:100%;">
                        
                        <h3 style="margin-top: 100px; margin-bottom: 100px;">AUTHORIZATION RELEASE</h3>
                        
                        <p>I hereby give my permission for my child to participate in activitis in connection with my child's enrollment in the mind development course, given by the trained staff representatives of "Developing your Mind" at their indoor facilities.</p>
                        <p>I understand that my participation in the follow up of the home work activities are an important part of the mind development process, and therefore, I agree to participate and follow in full the recommendations fiven by the instructor in each weekly session in accordance to optimize results in the development process of my child.</p>
                    
                        <p style="margin-top: 60px;">
                            Name of Parent/Guardian:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">_____________________________________________________________________________________________</span>
                        </p>
                        <p style="margin-top: 60px;">
                            Signature of Parent/Guardian:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">_____________________________________________________________________________________________</span>
                        </p>
                        <p style="margin-top: 60px;">
                            Date:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">________________________________________________________</span>
                        </p>
                    </section>
                </div>  

                <div class="page" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif; page-break-after:always; box-sizing:border-box;">
                    <section class="format_content" style="width:100%;">
                        
                        <h3 style="margin-top: 100px; margin-bottom: 100px;">DISCLAIMER</h3>
                        
                        <p>The development provided in this space or under the name of "Developing your Mind" can <strong>not</strong> and <strong>does not</strong> replace the advice of any health professional (Medical Physician, Psychiatrist, Psychologist, or other). It should <strong>not</strong> be construed as an attempt to provide medical services, advice, diagnosis, or treatment that could interfere with any medical, psychiatric, or psychological practice.</p>
                        <p>I fully understand that the services provided by Developing Your Mind, <strong>do not</strong>, replace in any way the advice or services of any health professional Medical phyisician, psychiatrist, psychologist. And that the services provided by "Developing you mind" should be taken only as an Alternative method for intellectual and human development: therefore the application and outcome of the techniques here provided are the sole responsibility of the individuals who attend to take the development courses.</p>
                    
                        <p style="margin-top: 60px;">
                            Name of Parent/Guardian:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">_____________________________________________________________________________________________</span>
                        </p>
                        <p style="margin-top: 60px;">
                            Signature of Parent/Guardian:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">_____________________________________________________________________________________________</span>
                        </p>
                        <p style="margin-top: 60px;">
                            Date:
                            <span style="width: 900px; display:block;  font-weight:700; margin-top: 20px;">________________________________________________________</span>
                        </p>
                    </section>
                </div>  

    </body>
    </html>
    
  <?php

} // end format_VXM_003()



add_filter('acf/load_field/name=faq_category', 'acf_load_category_field_choices');
function acf_load_category_field_choices( $field ) {
    
	$args = array(
		'post_type' => 'faq_category_input',
		'numberposts' => 10,
        'post_status'    => 'publish',
        'meta_key' => 'faq_category_input'
	);

	$query = new WP_Query( $args );

    $choices = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
            $query->the_post();
            $choices[] = get_post_meta( get_the_ID(), 'faq_category_input', true);
		}
	}
	wp_reset_postdata();
  
    // remove any unwanted white space
    $choices = array_map('trim', $choices);
    $field['choices'] = array();
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            $field['choices'][ $choice ] = $choice;
        }
    }
    
    return $field;
}

add_filter('acf/load_field/name=faq_inst_category', 'acf_load_inst_category_field_choices');
function acf_load_inst_category_field_choices( $field ) {
    
	$args = array(
		'post_type' => 'faq_inst_cat_input',
		'numberposts' => 10,
    'post_status'    => 'publish',
    'meta_key' => 'faq_inst_cat_input'
	);

	$query = new WP_Query( $args );

  $choices = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
      $query->the_post();
      $choices[] = get_post_meta( get_the_ID(), 'faq_inst_cat_input', true);
		}
	}
	wp_reset_postdata();
  
  // remove any unwanted white space
  $choices = array_map('trim', $choices);

  // loop through array and add to field 'choices'
  if( is_array($choices) ) {
      foreach( $choices as $choice ) {
          $field['choices'][ $choice ] = $choice;
      }
  }
  
  return $field;
}




add_filter('acf/load_field/name=faq_cert_category', 'acf_load_cert_category_field_choices');
function acf_load_cert_category_field_choices( $field ) {
    
	$args = array(
		'post_type' => 'faq_cert_cat_input',
		'numberposts' => 10,
    'post_status'    => 'publish',
    'meta_key' => 'faq_cert_cat_input'
	);

	$query = new WP_Query( $args );

  $choices = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
      $query->the_post();
      $choices[] = get_post_meta( get_the_ID(), 'faq_cert_cat_input', true);
		}
	}
	wp_reset_postdata();
  
  // remove any unwanted white space
  $choices = array_map('trim', $choices);

  // loop through array and add to field 'choices'
  if( is_array($choices) ) {
      foreach( $choices as $choice ) {
          $field['choices'][ $choice ] = $choice;
      }
  }
  
  return $field;
}


add_filter('acf/load_field/name=entry_inst_category', 'acf_load_entry_inst_category_field_choices');
function acf_load_entry_inst_category_field_choices( $field ) {
    
	$args = array(
		'post_type' => 'entry_inst_cat_input',
		'numberposts' => 10,
    'post_status'    => 'publish',
    'meta_key' => 'entry_inst_cat_input'
	);

	$query = new WP_Query( $args );

  $choices = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
      $query->the_post();
      $choices[] = get_post_meta( get_the_ID(), 'entry_inst_cat_input', true);
		}
	}
	wp_reset_postdata();
  
  // remove any unwanted white space
  $choices = array_map('trim', $choices);

  // loop through array and add to field 'choices'
  if( is_array($choices) ) {
      foreach( $choices as $choice ) {
          $field['choices'][ $choice ] = $choice;
      }
  }
  
  return $field;
}



add_filter('acf/load_field/name=entry_cert_category', 'acf_load_entry_cert_category_field_choices');
function acf_load_entry_cert_category_field_choices( $field ) {
    
	$args = array(
		'post_type' => 'entry_cert_cat_input',
        'post_status'    => 'publish',
        'meta_key' => 'entry_cert_cat_input'
	);

	$query = new WP_Query( $args );

    $choices = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
            $query->the_post();
            $choices[] = get_post_meta( get_the_ID(), 'entry_cert_cat_input', true);
		}
	}
	wp_reset_postdata();
  
    // remove any unwanted white space
    $choices = array_map('trim', $choices);

    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            $field['choices'][ $choice ] = $choice;
        }
    }
    
    return $field;
}








add_action('test_mailing_action','test_mailing');
function test_mailing(){



	$args = array(
		'post_type' => 'faq_category_input',
		'numberposts' => 10,
    'post_status'    => 'publish',
    'meta_key' => 'faq_category_input'
	);

	$query = new WP_Query( $args );


    // Set $to as the email you want to send the test to.
    $to = "pruebascatel@gmail.com";
    
    // No need to make changes below this line.
    
    // Email subject and body text.
    $subject = 'wp_mail function test';
    $message = 'This is a test of the wp_mail function: wp_mail is working';
    $headers = '';

    // send test message using wp_mail function.
    $sent_message = wp_mail( $to, $subject, $message, $headers );
    //display message based on the result.
    if ( $sent_message ) {
        // The message was sent.
        echo 'The test message was sent to '.$to.'. Check your email inbox.';
    } else {
        // The message was not sent.
        echo 'The message was not sent!';
    }
    

    $t=time();
    echo($t . "<br>");
    echo(date("Y-m-d",$t));

}


add_filter( 'hf_validate_form', 'validate_pass_reset', 10, 3 );
function validate_pass_reset( $error_code, $form, $data ) {
    $pass_1 =  $_POST['pass_1'];
    $pass_2 =  $_POST['pass_2'];
	if( $pass_1 !== $pass_2  ) {
		$error_code = 'not_the_same'; 
	} else {
        // here goes the logic
        $args = array(
            'post_type' => 'aspirantes',
            'numberposts' => 1,
            'post_status'    => 'publish',
            'meta_key' => '_userid',
            'meta_value' => get_current_user_id()
        );

        $query = new WP_Query($args);
        // this while is intented to have one iteration since we are only going to change the current user password
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $pass_changed = get_post_meta( get_the_ID(), 'pass_changed', true);
                update_post_meta(get_the_ID(), 'pass_changed', 'changed', 'not_changed');

                $status = get_field('status', get_the_ID());
                if($status == '00'){
                    update_field('field_5809034ffa525', '01', get_the_ID());
                    // update_field('field_5809034ffa525', '01', get_the_ID());

                }
            }
        }

        if($pass_changed === 'not_changed'){
            wp_set_password($pass_1, get_current_user_id());
        }
    }
    return $error_code;
}


add_filter( 'hf_form_message_not_the_same', function( $message ) {
    return 'Los campos no coinciden, por favor reingresa la contraseña';
});

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
function my_login_redirect( $redirect_to, $request, $user ) {
    
    $user_id =  $user->ID;

    if($user_id !== NULL){
    
        $args = array(
            'post_type' => 'aspirantes',
            'numberposts' => 1,
            'post_status'    => 'publish',
            'meta_key' => '_userid',
            'meta_value' => $user_id
        );

        $query = new WP_Query($args);   

        // this while is intented to have one iteration since we are only going to change the current user password
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $post = $query->the_post();
                $post_id = get_the_ID();
                $pass_status = get_post_meta( $post_id, 'pass_changed', true);
                $status = get_field('_status', $post_id);
            }
        }

        if($pass_status == 'not_changed'){
            $redirect_to = get_permalink(1817).'&post_id='.$post_id.'&user_id='.$user_id;
        } else if ($pass_status == 'changed' && $status == '01'){
            $redirect_to = get_permalink(1855);
        }
    }
    return $redirect_to;    
}

add_action('hf_form_success', 'OFI_3_hanlde');
function OFI_3_handle($submission, $form){

}
// add_filter( 'hf_validate_form', 'OFI_3_handle', 10, 3 );
// function OFI_3_handle( $error_code, $form, $data ) {
//     $pass_1 =  $_POST['pass_1'];
//     $pass_2 =  $_POST['pass_2'];
// 	if( $pass_1 !== $pass_2  ) {
// 		$error_code = 'not_the_same'; 
// 	} else {
//         // here goes the logic
//         $args = array(
//             'post_type' => 'aspirantes',
//             'numberposts' => 1,
//             'post_status'    => 'publish',
//             'meta_key' => '_userid',
//             'meta_value' => get_current_user_id()
//         );

//         $query = new WP_Query($args);
//         // this while is intented to have one iteration since we are only going to change the current user password
//         if ( $query->have_posts() ) {
//             while ( $query->have_posts() ) {
//                 $query->the_post();
//                 $pass_changed = get_post_meta( get_the_ID(), 'pass_changed', true);
//                 update_post_meta(get_the_ID(), 'pass_changed', 'changed', 'not_changed');

//                 update_field('field_5809034ffa525', '01', get_the_ID());
//             }
//         }

//         if($pass_changed === 'not_changed'){
//             wp_set_password($pass_1, get_current_user_id());
//         }
//     }
//     return $error_code;
// }


add_shortcode('lps_current_username', 'lps_current_username_func');
function lps_current_username_func(){
    $user = wp_get_current_user();

    $args = array(
        'post_type' => 'aspirantes',
        'numberposts' => 1,
        'post_status'    => 'publish',
        'meta_key' => '_userid',
        'meta_value' => $user->ID

    );

    $first_name = 'NO_INFO';
    $last_name = '';
    $query = new WP_Query($args);
    // this while is intented to have one iteration since we are only going to change the current user password
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $full_name = get_post_meta( get_the_ID(), 'ASP_nombre_completo', true);
            // $last_name = get_post_meta( get_the_ID(), 'O-1-AApellidosDelAspirante', true);
        }
    }

    return $full_name;
}

add_shortcode('lps_current_userdir', 'lps_current_userdir_func');
function lps_current_userdir_func(){
    $user = wp_get_current_user();

    $args = array(
        'post_type' => 'aspirantes',
        'numberposts' => 1,
        'post_status'    => 'publish',
        'meta_key' => '_userid',
        'meta_value' => $user->ID

    );

    $colonia = 'NO_INFO';
    // $calle = '';
    // $municipio = '';
    // $estado = '';
    // $pais = '';
    $query = new WP_Query($args);
    // this while is intented to have one iteration since we are only going to change the current user password
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $colonia = get_post_meta( get_the_ID(), 'ASP_colonia', true);
            $calle = get_post_meta( get_the_ID(), 'ASP_calle', true);
            $municipio = get_post_meta( get_the_ID(), 'ASP_municipio', true);
            $estado = get_post_meta( get_the_ID(), 'ASP_estado', true);
            $pais = get_post_meta( get_the_ID(), 'ASP_pais', true);

        }
    }
    // echo 'hey';
    // return 'hey';
    return $calle.' '.$colonia.' '.$municipio.' '.$estado.' '.$pais;
}






add_action('init','lps_contrat_handle');
function lps_contrat_handle(){
  if(isset($_REQUEST['action']) && $_REQUEST['action']=='lps_check_contrat') {

    $user_id = intval($_REQUEST['user_id']);
    $selected =  $_REQUEST['selected'];

    $args = array(
        'post_type' => 'aspirantes',
        'numberposts' => 1,
        'post_status'    => 'publish',
        'meta_key' => '_userid',
        'meta_value' => $user_id
    );

    $query = new WP_Query($args);
    // this while is intented to have one iteration since we are only going to change the current user password
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();
        }
    }

    if($selected == 'accept'){
        update_field('field_5809034ffa525', '05', $post_id);
        wp_redirect(get_the_permalink(2));


        include_once (ABSPATH .'testpdf.php');
        create_contrat($post_id, $user_id);  



    } else if ($selected == 'accept_not'){
        update_field('field_5809034ffa525', '02', $post_id);
        wp_redirect(get_the_permalink(2));
    }
    exit();
  }
  
}




/* DON'T DELETE THIS CLOSING TAG */ ?>