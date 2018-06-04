<?php
include_once(ABSPATH . '/wp-includes/wp-db.php');
global $wpdb;
$mensaje = '';


?>
<?php wp_head(); ?>
<style type="text/css">
    .table{
        display: block;
    }

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
    .paginacion
    {
        display: block;
    }
    #footer-thankyou
    {
        display: none;
    }

    .formwrapper{
        display:-webkit-flex;
        -webkit-justify-content:center;

        display:flex;
        justify-content:center;
    }

    .formwrapper > * {
        -webkit-flex:1;
        flex:1;
        border:thin solid;
    }

    .rango-fechas {
        float:left;
        width:50%;
        display: inline-block;
    }
    .filtro-cobro{
         float:left;
         width:30%;
         display: inline-block;
    }
    .acciones {
        float:left;
        width:20%;
        height:100%;
        display: inline-block;
    }
    .wrap > table
    {
        width:100%;
    }
    .form-class > * {
        margin:0;
        padding:0;
    }
    .button {
            cursor:pointer;
            padding:5px 25px;
            background:#35b128;
            border:1px solid #33842a;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            border-radius: 10px;
            -webkit-box-shadow: 0 0 4px rgba(0,0,0, .75);
            -moz-box-shadow: 0 0 4px rgba(0,0,0, .75);
            box-shadow: 0 0 4px rgba(0,0,0, .75);
            color:#f3f3f3;
            font-size:1.1em;
    }
    .button:hover, .button:focus{
        background-color :#399630;
        -webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);
        -moz-box-shadow: 0 0 1px rgba(0,0,0, .75);
        box-shadow: 0 0 1px rgba(0,0,0, .75);
     }

     #wpfooter {
          display: none;
     }

     #buscadorCurso{
         display: block;
     }

      #costoInput{
          display: block;
      }

     #mainSection {
         display: block;
     }
</style>


<!--
<script src="wp-content/plugins/aiowebvxm-plugin/admin/js/jquery.js"></script>
<script src="wp-content/plugins/aiowebvxm-plugin/admin/js/jquery.slim.min.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
-->
<section id="mainSection">
    <section>
        <h3>Crear Fechas</h3>
        <label>Fecha Inicial</label><br/>
        <input id="startDate" type="datetime-local" name="dates[start_date]" required="true" /><br/>
        <label>Fecha Fin</label><br/>
        <input id="endDate" type="datetime-local" name="dates[end_date]" required="true" />
        <div class="user-widget">
            <label>Impartido por: </label><br />
            <input id="instructor" />
            <section id="instructorInput">
            </section>
        </div>
        <label>Costo:</label><br />
        <input id="costoInput"type="number" min="0" step="any" />
        <label>Buscar Curso:</label><br />
        <input id="buscadorCurso" />
        <section id="infoCurso" ></section>
        <section id="btnSection">
            <button id="crearFechaBtn" name="crearFecha">Crear</button>
            <button id="btnVaciar" name="vaciar">Vaciar</button>
        </section>
    </section>

    <section>
        <h3>Editar Fechas</h3>
    </section>
</section>


<script>

jQuery(function() {

getCostoCurso = function(){
    return jQuery('#costoInput').attr("value");
};

getNombreCurso = function()
{
    return jQuery('#buscadorCurso').prop( "value");
};

getIdCurso = function (){
    return document.getElementsByClassName('curso-name')[0].getAttribute('cursos_id');
};

getFechaInicial = function(){
        return document.getElementById("startDate").value;
};
getFechaFinal = function(){
        return document.getElementById("endDate").value;
};
getIdInstructor = function (){
    return jQuery('#user-name').attr("value");
};
    jQuery( "#crearFechaBtn" ).prop( "disabled", true );
    jQuery( "#instructor" ).autocomplete({
        source: function(request, response) {
            jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/wp-admin/admin-ajax.php' ,
            //jsonp:false, // make it to false, to use your function on JSON RESPONSE
            //jsonpCallback: 'response',
            data: {
			            action: 'search_user',
                       q: document.getElementById("instructor").value
		    },
            success: function(data) {

                response(data);
            }
        });
    },
    select: function (event, ui) {

        jQuery("#instructorInput").html('<span id="user-name" value="'+ui.item.user_id+'">'+ui.item.label+'</span>');
    }
 });

 jQuery("#btnVaciar").click(function(e){
      e.preventDefault();
      jQuery("#instructorInput").html('');
      jQuery("#infoCurso").html('');
      jQuery("#costoInput").prop( "value", '' );
      jQuery("#instructor").prop( "value", '' );
      jQuery( "#crearFechaBtn" ).prop( "disabled", true );
 });

jQuery( "#crearFechaBtn" ).click(function(e){
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/wp-admin/admin-ajax.php' ,
        data: {
                    action: 'crear_fecha',
                   q:{
                       curso_id: getIdCurso(),
                       instructor_id: getIdInstructor(),
                       dates:{
                           start_date: getFechaInicial(),
                           end_date: getFechaFinal()
                       },
                       costo: getCostoCurso()
                   }
        },
        success: function(data) {

            response(data);
        }
    });
});

 jQuery( "#buscadorCurso" ).autocomplete({
     source: function(request, response) {
         jQuery.ajax({
         type: 'POST',
         dataType: 'json',
         url: '/wp-admin/admin-ajax.php' ,
         data: {
                     action: 'search_curso',
                    q:{
                        nombre: getNombreCurso()
                    }
         },
         success: function(data) {

             response(data);
         }
     });
 },
 select: function (event, ui) {

     jQuery("#infoCurso").html('<label>Nombre Curso:</label><section>Id:('+ui.item.id+')</section><label class="curso-name" cursos_id="'+ui.item.id+'" value="'+ui.item.label+'"></label><textarea disabled="true" id="descripcionCurso" rows="4" cols="50" >'+ui.item.descripcion+'</textarea>');
     jQuery( "#crearFechaBtn" ).prop( "disabled", false );
 }
 });

});



</script>
    <div class="paginacion">

    </div>
</div>
