<?php
include_once(ABSPATH . '/wp-includes/wp-db.php');
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
global $wpdb;
$plugin_directory = plugins_url() . '/aiowebvmx-plugin/';
//$url = urlencode($_SERVER['HTTP_HOST'] . '/qr?code=');
?>
<style>

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
        cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/
        padding:5px 25px; /*add some padding to the inside of the button*/
        background:#35b128; /*the colour of the button*/
        border:1px solid #33842a; /*required or the default border for the browser will appear*/
        /*give the button curved corners, alter the size as required*/
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        /*give the button a drop shadow*/
        -webkit-box-shadow: 0 0 4px rgba(0,0,0, .75);
        -moz-box-shadow: 0 0 4px rgba(0,0,0, .75);
        box-shadow: 0 0 4px rgba(0,0,0, .75);
        /*style the text*/
        color:#f3f3f3;
        font-size:1.1em;
}
.button:hover, .button:focus{
    background-color :#399630; /*make the background a little darker*/
    /*reduce the drop shadow size to give a pushed button effect*/
    -webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);
    -moz-box-shadow: 0 0 1px rgba(0,0,0, .75);
    box-shadow: 0 0 1px rgba(0,0,0, .75);
 }
/* highlight results */
.ui-autocomplete span.hl_results {
    background-color: #ffff66;
}

/* loading - the AJAX indicator */
.ui-autocomplete-loading {
    background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat;
}

/* scroll results */
.ui-autocomplete {
    max-height: 250px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
    /* add padding for vertical scrollbar */
    padding-right: 5px;
}
     .wrap{
        float:left;
        width:100%;
        display: inline-block;
    }

        .wrap > table
        {
            width
        }

.ui-autocomplete li {
    font-size: 16px;
}

/* IE 6 doesn't support max-height
* we use height instead, but this forces the menu to always be this tall
*/
* html .ui-autocomplete {
    height: 250px;
}

.user-name {
    border-bottom-color: #ff;
    border-left-color: #ff;
    border-left-width: 4px;
    border-bottom-width: 4px;
}
</style>
<div class="wrap">
    <div class="paginacion">

    </div>
    <table>
        <thead>
            <tr><th>Total a Cobrar</th><th>Nombre Instructor</th><th>Instructor Id</th><th>Nombre Curso</th><th>Folio Curso Impartido</th><th>No. Alumnos</th><th>Fecha Inicio</th></tr>
        </thead>
        <tbody id="tableBody">

        </tbody>
    </table>
    <div class="paginacion">

    </div>
</div>
<footer>
<script type="text/javascript">
jQuery(function() {

    getUserId = function(){
        return jQuery("#user-name").attr("value");
    }
    getCobrado = function(){
        return jQuery( "input:checked" ).val();
    }

    getStartDate = function () {
        return jQuery( "#startDate" ).val();
    }
    getEndDate = function () {
        return jQuery( "#endDate" ).val();
    }
    jQuery( "#alumnos" ).autocomplete({
        source: function(request, response) {
            jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/wp-admin/admin-ajax.php' ,
            //jsonp:false, // make it to false, to use your function on JSON RESPONSE
            //jsonpCallback: 'response',
            data: {
			            action: 'search_user',
                       q: document.getElementById("alumnos").value
		    },
            success: function(data) {

                response(data);
            }
        });
    },
    select: function (event, ui) {

        jQuery("#alumnoInput").html('<span id="user-name" value='+ui.item.user_id+'>'+ui.item.label+'</span><span><button id="btnVaciar" name="vaciar">Vaciar</button>');
    }
 });
    jQuery("#alumnoInput").on('click','#btnVaciar',function(e){
         e.preventDefault();
         jQuery("#alumnoInput").html('');
         jQuery('#tableBody').html('');
    });

        jQuery("#calcularBtn").click(function(e,response){
        jQuery('#tableBody').html('');
         e.preventDefault();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/wp-admin/admin-ajax.php' ,
                data: {
                            action: 'calcular',
                        q: {
                            user_id: getUserId(),
                            dates: {
                              start_date: getStartDate(),
                              end_date: getEndDate()
                            },
                            cobrado: getCobrado()
                        }
                },
                success: function(data) {
                    jQuery.each(data.desglose, function (index, value) {
                        tdRow = jQuery('<tr></tr>');
                        jQuery.each(value, function (index, attributo) {
                            tdRow.append('<td>'+attributo+'</td>');
                        });
                        tdRow.clone().appendTo('#tableBody');
                    });
                    //jQuery('#tableBody').append(tdRow);
                    tdTotal = jQuery('<tr><td>'+data.total+'</td><td>Total</td></tr>');
                    jQuery('#tableBody').append(tdTotal);
                }
            });
    });

  } );
</script>
</footer>
