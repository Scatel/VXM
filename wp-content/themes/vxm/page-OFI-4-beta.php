<?php
/*
Template Name: OFI-4-beta
*/


$aspirante_niveo = 'I000364';
$aspirante_name = 'DESIDERIO CAAMAL';
$alumno_num = '1857';
$alumno_name = 'ADRIANA PEREZ';
$imagen_num = '4';
$imagen = 'la casa';
$imagen_descripcion = 'Una casa con pasto y un árbol';

?>



<?php get_header(); ?>
<style>
    #ofi-4-alpha .row {
        display: flex;
        flex-wrap: wrap;
    }

    .row div {
        width: 33%;
    }

</style>



<div class="container" style="margin-top: 150px;" id="ofi-4-alpha">
<h4>Captura de cuestionario / Impresión de recomendaciones</h4>

<div style="display: flex; flex-wrap: wrap;">
    <div style="width: 33%;">
        <label>No. de instructor:</label>
    </div>
    <div style="width: 33%;">
        <p>
            <?php echo $aspirante_niveo;?>
        </p>
    </div>
    <div style="width: 33%;">
        <p>
            <?php echo $aspirante_name;?>
        </p>
    </div>
</div>

<div style="display: flex; flex-wrap: wrap;">
    <div style="width: 33%;">
        <label>No. de instructor:</label>
    </div>
    <div style="width: 33%;">
        <p>
            <?php echo $alumno_num;?>
        </p>
    </div>
    <div style="width: 33%;">
        <p>
            <?php echo $alumno_name;?>
        </p>
    </div>
</div>
<div style="display: flex; flex-wrap: wrap;">

    <div style="width: 33%;">

        <label>No. de imagen:</label>
    </div>
    <div style="width: 33%;">
        <p>
            <?php echo $imagen_num;?>
        </p>
    </div>

    <div style="width: 33%;">
        <p>
            Imagen: <?php echo $imagen;?>
        </p>
        <p>
            Descripcion: <?php echo $imagen_descripcion;?>
        </p>
    </div>
</div>

<?php echo do_shortcode('[hf_form slug="ofi-4-beta"]');?>

</div>



<?php get_footer(); ?>




