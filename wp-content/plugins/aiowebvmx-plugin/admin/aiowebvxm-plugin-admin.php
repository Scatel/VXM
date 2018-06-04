<?php
include_once(ABSPATH . '/wp-includes/wp-db.php');
global $wpdb;
if (!empty($_POST['cantidad_fs'])) {
    $cantidad=$_POST['cantidad_fs'];
    if (!empty($_POST['evento_fs'])) {
        $evento=$_POST['evento_fs'];
    }
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    ##se necesitan los usuairos asignados aa un evento como parametro en generateUsers con el id del evento definido
}
$cursos_impartidos = $wpdb->get_results('select * from '.$wpdb->prefix.'vxm_cursos_impartido as e', OBJECT);
?>
<header>

<style type="text/css">
    .row{
        width: 90%;
    }
    .row input[type="text"], .row select, .row label{
        display: inline-block;
    }

    .row label{
        margin: 12px;
        text-align: right;
        width: 25%;
    }
    .row input[type="text"], .row select{
        margin: 3px;
    }
    .user-widget > *
    {
        float:left;
        width:50%;
        display: inline-block;
    }
    #alumnoInput:nth-child(0)
    {
        float:left;
        width:50%;
        display: inline-block;
    }
    #alumnoInput:nth-child(1)
    {
        float:right;
        width:50%;
        display: inline-block;
    }
</style>
<?php wp_head(); ?>

</header>

<div class="wrap">
    <h2>Viendo por el Mundo Plugin</h2>
    <form class="form-class" method="post">
        <div class="user-widget">
            <label for="alumnos">Maestro: </label>
            <input id="alumnos">
            <section id="alumnoInput">
            </section>
        </div>
        <fieldset class="rango-fechas">
        <input id="startDate" type="datetime-local" name="dates[start_date]"> Fecha Minima<br>
        <input id="endDate" type="datetime-local" name="dates[end_date]"> Fecha Maxima<br>
        </fieldset>
        <fieldset class="filtro-cobro">
            <legend>Filtro Cobro</legend>
                <input type="radio" name="cobrado" value="1" />Cobrado<br />
                <input type="radio" name="cobrado" value="2" />Sin cobrar<br />
                <input type="radio" name="cobrado" value="3" />Todos<br />
        </fieldset>
        <fieldset class="acciones">
        <button type="button" id="buscarBtn">Buscar</button>
        <button type="button" id="calcularBtn">Calcular</button>
        </fieldset>
    </form>
    <form method="post" action="<?php echo  $_SERVER['REQUEST_URI']; ?>">
        <div class="row">

        </div>
    </form>
</div>
