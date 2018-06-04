<?php
/*
  Plugin Name: Aioweb-viendo-x-mundo
  Description: Administra Cobranza de cursos impartidos.
  Version: 1.0
  Author: Aldo Polanco
  License: GPL2
 */

//require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//SETUP
global $jal_db_version;
$jal_db_version = "1.0";
include_once(ABSPATH . '/wp-includes/wp-db.php');
function aiowebvxm_plugin_install() {
    //Do some installation work
    global $wpdb;
    $template_directory=get_template_directory();
    $plugin_directory=plugins_url().'/viendo-por-el-mundo-admin/';
    $copy_files=array();
    $f_functions=null;
    /* creating calatogos */

    $wpdb->query("CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."vxm_cursos (id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,nombre_curso VARCHAR(45) NOT NULL, descripcion TEXT NULL);");
    $wpdb->query("CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."vxm_cursos_impartido (
                    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    cursos_id INT(11) UNSIGNED NOT NULL,
                    instructor_id BIGINT( 20 ) UNSIGNED NOT NULL,
                    fecha_inicio TIMESTAMP NULL DEFAULT NULL,
                    fecha_final	TIMESTAMP NULL DEFAULT NULL,
                    costo DOUBLE NOT NULL DEFAULT  '0',
                    cobrado tinyint(4) NOT NULL DEFAULT '0'
                    );");
    $wpdb->query("CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."vxm_alumnos_curso_impartido (
                    cursos_impartido_id INT(11) UNSIGNED,
                    alumno_id BIGINT( 20 ) UNSIGNED NOT NULL
                    );");

}

function aiowebvxm_plugin_unininstall()
{
    $wpdb->query("DROP TABLE IF EXISTS ".$wpdb->prefix."vxm_alumnos_curso_impartido;");
    $wpdb->query("DROP TABLE IF EXISTS  ".$wpdb->prefix."vxm_cursos_impartido;");
    $wpdb->query("DROP TABLE IF EXISTS  ".$wpdb->prefix."vxm_cursos;");

}

function user_search_ajax_process_request() {
    global $wpdb;
    header('Content-Type: application/json;charset=utf-8');
  	if ( isset( $_POST["q"] ) ) {
		//
		$usuarios = $wpdb->get_results('select u.user_nicename as value,u.id as user_id , CONCAT(u.user_nicename, " ", u.user_email) as label, u.user_email as email from '.$wpdb->prefix.'users as u where u.user_nicename LIKE "%'.$_POST["q"].'%"', OBJECT);
		//
		echo json_encode($usuarios);
		die();
	}
}

function total_ajax_calcular() {
    global $wpdb;
    header('Content-Type: application/json;charset=utf-8');
  	if ( isset( $_POST["q"] ) ) {

      if(isset($_POST["q"]['cobrado']))
      {

          switch($_POST["q"]['cobrado'])
          {
              case '1':
                  $queryString = 'cobrado = 1';
                  break;
              case '2':
                  $queryString = 'cobrado = 0';
                  break;
              case '3':
                  $queryString = 'cobrado IN (0,1)';
          }
      }else
      {
          $queryString = 'cobrado IN (0,1)';
      }
      if(isset($_POST["q"]['dates']))
      {
          if($_POST["q"]['dates']['start_date']!=""&&$_POST["q"]['dates']['end_date']!="")
          {
              $dateWhere = ' (fecha_inicio BETWEEN "'.$_POST["q"]['dates']['start_date'].'" AND "'.$_POST["q"]['dates']['end_date'].'")';
          }elseif($_POST["q"]['dates']['start_date']!=""&&$_POST["q"]['dates']['end_date']=="")
          {
              $dateWhere = ' fecha_inicio >="'.$_POST["q"]['dates']['start_date'].'"';
          }elseif($_POST["q"]['dates']['start_date']==""&&$_POST["q"]['dates']['end_date']!="")
          {
              $dateWhere = ' fecha_inicio <= "'.$_POST["q"]['dates']['end_date'].'"';
          }
          if(isset($_POST["q"]['cobrado'])&&isset($dateWhere))
          {
              $queryString = $queryString.' AND '.$dateWhere;
          }
      }
      if(isset($_POST["q"]['user_id'])&&isset($queryString))
      {
        $queryString = $queryString .' AND u.id ='.$_POST["q"]['user_id'];
      }elseif(isset($_POST["q"]['user_id'])&&!isset($queryString))
      {
        $queryString = 'u.id ='.$_POST["q"]['user_id'];
      }

        $response = [];
        $total = 0;
		$calculo = $wpdb->get_results('SELECT SUM( costo ) as subtotal , u.user_nicename, u.id AS user_id, wc.nombre_curso, '.$wpdb->prefix.'vxm_cursos_impartido.id as curso_impartido_id, COUNT( '.$wpdb->prefix.'vxm_alumnos_curso_impartido.alumno_id )  as numeroAlumnos,'.$wpdb->prefix.'vxm_cursos_impartido.fecha_inicio as fecha_inicio
            FROM  '.$wpdb->prefix.'vxm_cursos_impartido
            RIGHT JOIN '.$wpdb->prefix.'vxm_alumnos_curso_impartido ON  '.$wpdb->prefix.'vxm_cursos_impartido.id = '.$wpdb->prefix.'vxm_alumnos_curso_impartido.cursos_impartido_id
            LEFT JOIN '.$wpdb->prefix.'users AS u ON u.id = '.$wpdb->prefix.'vxm_cursos_impartido.instructor_id
            LEFT JOIN '.$wpdb->prefix.'vxm_cursos AS wc ON wc.id = '.$wpdb->prefix.'vxm_cursos_impartido.cursos_id
            WHERE '.$queryString.'
            GROUP BY '.$wpdb->prefix.'vxm_cursos_impartido.id, wc.nombre_curso', OBJECT);
        $response['desglose'] = $calculo;
        foreach($calculo as $c)
        {
            $total += $c->subtotal;
        }
        $response['total'] = $total;
		echo json_encode($response);
		die();
	}
}

function ajax_buscar_curso_impartido()
{
    global $wpdb;
    if (!empty($_POST)) {
        if(isset($_POST['cobrado']))
        {

            switch($_POST['cobrado'])
            {
                case '1':
                    $queryString = 'cobrado = 1';
                    break;
                case '2':
                    $queryString = 'cobrado = 0';
                    break;
                case '3':
                    $queryString = 'cobrado IN (0,1)';
            }
        }else
        {
            $queryString = 'cobrado IN (0,1)';
        }
        if(isset($_POST['dates']))
        {
            if($_POST['dates']['start_date']!=""&&$_POST['dates']['end_date']!="")
            {
                $dateWhere = ' (fecha_inicio BETWEEN "'.$_POST['dates']['start_date'].'" AND "'.$_POST['dates']['end_date'].'")';
            }elseif($_POST['dates']['start_date']!=""&&$_POST['dates']['end_date']=="")
            {
                $dateWhere = ' fecha_inicio >="'.$_POST['dates']['start_date'].'"';
            }elseif($_POST['dates']['start_date']==""&&$_POST['dates']['end_date']!="")
            {
                $dateWhere = ' fecha_inicio <= "'.$_POST['dates']['end_date'].'"';
            }
            if(isset($_POST['cobrado'])&&isset($dateWhere))
            {
                $queryString = $queryString.' AND '.$dateWhere;
            }
        }
        $cursos_impartidos = $wpdb->get_results('select wpci.*, '.$wpdb->prefix.'vxm_cursos.*, u.user_nicename from '.$wpdb->prefix.'vxm_cursos_impartido AS wpci LEFT JOIN '.$wpdb->prefix.'vxm_cursos ON '.$wpdb->prefix.'vxm_cursos.id = wpci.cursos_id
    LEFT JOIN '.$wpdb->prefix.'users as u ON u.id = wpci.instructor_id WHERE '.$queryString, OBJECT);
    }else
    {
        $cursos_impartidos = $wpdb->get_results('select wpci.*, '.$wpdb->prefix.'vxm_cursos.*, u.user_nicename from '.$wpdb->prefix.'vxm_cursos_impartido AS wpci LEFT JOIN '.$wpdb->prefix.'vxm_cursos ON '.$wpdb->prefix.'vxm_cursos.id = wpci.cursos_id
    LEFT JOIN '.$wpdb->prefix.'users as u ON u.id = wpci.instructor_id', OBJECT);
    }
    echo json_encode($cursos_impartidos);
    die();
}

function ajax_buscar_curso()
{
    global $wpdb;
    header('Content-Type: application/json;charset=utf-8');
    if ( isset( $_POST["q"] ) ) {
        $calculo = $wpdb->get_results('SELECT id, nombre_curso as label, descripcion
            FROM  '.$wpdb->prefix.'vxm_cursos
            WHERE  `nombre_curso` Like "%'.$_POST["q"]["nombre_curso"].'%" or descripcion like "%'.$_POST["q"].'%"', OBJECT);
        echo json_encode($calculo);
        die();
    }
}

function ajax_crear_curso()
{
    global $wpdb;
    header('Content-Type: application/json;charset=utf-8');
    if ( isset( $_POST["q"] ) ) {
        $response = $wpdb->get_results('Insert into '.$wpdb->prefix.'vxm_cursos (nombre_curso,descripcion) VALUES ("'.$_POST["q"]['nombre_curso'].'","'.$_POST["q"]['descripcion'].'")', OBJECT);
        echo json_encode($response);
        die();
    }
}

function ajax_editar_curso()
{
    global $wpdb;
    header('Content-Type: application/json;charset=utf-8');
    if ( isset( $_POST["q"] ) ) {
        $response = $wpdb->get_results('update '.$wpdb->prefix.'vxm_cursos  set nombre_curso = "'.$_POST["q"]['nombre_curso'].'" , descripcion = "'.$_POST["q"]['descripcion'].'" where id='.$_POST["q"]['id'], OBJECT);
        echo json_encode($response);
        die();
    }
}

function ajax_crear_fecha()
{
    global $wpdb;
    header('Content-Type: application/json;charset=utf-8');
    if ( isset( $_POST["q"] ) ) {
        $response = $wpdb->get_results('Insert into '.$wpdb->prefix.'vxm_cursos_impartido (cursos_id,instructor_id,fecha_inicio,fecha_final,costo) VALUES ('.$_POST["q"]["curso_id"].','.$_POST["q"]["instructor_id"].',"'.$_POST["q"]["dates"]["start_date"].'","'.$_POST["q"]["dates"]["end_dates"].'",'.$_POST["q"]["costo"].')', OBJECT);
        echo json_encode($response);
        die();
    }
}

register_activation_hook(__FILE__, 'aiowebvxm_plugin_install');
register_uninstall_hook(__FILE__, 'aiowebvxm_plugin_unininstall');
register_activation_hook(__FILE__, 'jal_install_data');

//SCRIPTS
function aiowebvxm_plugin_scripts() {

    wp_enqueue_script('lifeband_plugin_script');
    wp_enqueue_script("jquery");
    wp_enqueue_script('jquery-ui-autocomplete');
    wp_enqueue_script('jquery-ui-core');
    wp_register_style( 'jquery-ui-styles','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );
	wp_enqueue_style( 'jquery-ui-styles' );
}

add_action('wp_enqueue_scripts', 'aiowebvxm_plugin_scripts');
/* f you want to run your program every time a visitor comes
 *  to your site, you can use the ‘init’ or ‘wp_loaded’ action
 *  to trigger your code: */

//HOOKS
add_action('init', 'aiowebvxm_plugin_init');
/* * ***************************************************** */
/* FUNCTIONS
 * ****************************************************** */

function aiowebvxm_plugin_init() {
    //do work
    aiowebvxm_plugin_install();
}



/* INITIALIZE THE ADMIN FUNCTIONS */

//1
function aiowebvxm_plugin_menu() {
    add_menu_page('Viendo por el mundo Plugin Options', 'Cobranza cursos Viendo por el mundo.', 'manage_options', 'aiowebvxm-plugin-menu', 'aiowebvxm_plugin_options');
}
function aiowebvxm_event_plugin_menu() {
    add_menu_page('Viendo por el mundo Cursos Plugin Options', 'Viendo por el mundo - Crear Fechas Curso', 'manage_options', 'aiowebvxm-plugin-event-menu', 'aiowebvxm_plugin_event_options');
}


function aiowebvxm_crear_curso() {
    add_menu_page('Viendo por el mundo Crear curso', 'Viendo por el mundo - Crear Curso', 'manage_options', 'aiowebvxm-plugin-crear-curso', 'aiowebvxm_crear_curso_menu');
}

function register_mysettings() {
    register_setting('aiowebvxm-settings-group', 'new_option_name');
    register_setting('aiowebvxm-settings-group', 'some_other_option');
    register_setting('aiowebvxm-settings-group', 'option_etc');
}

//2
add_action('admin_menu', 'aiowebvxm_plugin_menu');
add_action('admin_menu', 'aiowebvxm_event_plugin_menu');
add_action('admin_menu', 'aiowebvxm_crear_curso');
//3
function aiowebvxm_plugin_options() {
    include('admin/aiowebvxm-plugin-admin.php');
    include('admin/cursos-generados.php');
}
function aiowebvxm_plugin_event_options() {
    include('admin/cursos-admin.php');
}
function aiowebvxm_cursos_factory(){
    include('admin/aiowebvxm-generate-cursos.php');
}

function aiowebvxm_crear_curso_menu()
{
    include('admin/crear-curso.php');
}
add_action('wp_ajax_buscar','ajax_buscar_curso_impartido');
add_action('wp_ajax_search_user', 'user_search_ajax_process_request');
add_action('wp_ajax_calcular', 'total_ajax_calcular');
add_action('wp_ajax_search_curso', 'ajax_buscar_curso');
add_action('wp_ajax_crear_curso', 'ajax_crear_curso');
add_action('wp_ajax_editar_curso', 'ajax_editar_curso');
add_action('wp_ajax_crear_fecha','ajax_crear_fecha');

?>
