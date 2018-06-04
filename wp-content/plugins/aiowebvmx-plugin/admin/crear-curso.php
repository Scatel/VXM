<?php
include_once(ABSPATH . '/wp-includes/wp-db.php');
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
global $wpdb;
$plugin_directory = plugins_url() . '/aiowebvmx-plugin/';
$seccionLabels = ['CrearTabLabel'=>'Crear Curso'];
wp_head();
?>
<style type="text/css">
    .row{
        width: 90%;
    }

    #editSection:nth-child(1)
    {
        float:right;
        width:50%;
        display: inline-block;
    }
    #editSection:nth-child(3)
    {
        float:left;
        width:50%;
        display: inline-block;
    }
    #createSection{

    }
    #tableCursos
    {

    }
    #descripcionTxtArea
    {
        display: block;
    }
    .curso-name
    {
        display: block;
    }
    #buscadorCurso{
        display: block;
    }

    #pluginBody .tab {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Float the list items side by side */
    #pluginBody .tab li {float: left;}

    /* Style the links inside the list items */
    #pluginBody .tab li a {
        display: inline-block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of links on hover */
    #pluginBody .tab li a:hover {background-color: #ddd;}

    /* Create an active/current tablink class */
    #pluginBody .tab li a:focus, .active {background-color: #ccc;}

    /* Style the tab content */
    #pluginBody .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<body id="pluginBody">
    <ul class="tab">
      <li><a href="javascript:void(0)" class="tablinks" onclick="openSection(event, 'createSection')">Crear Curso</a></li>
      <li><a href="javascript:void(0)" class="tablinks" onclick="openSection(event, 'editSection')">Editar Curso</a></li>
      <li><a href="javascript:void(0)" class="tablinks" onclick="openSection(event, 'tableCursos')">Indice de Cursos</a></li>
    </ul>

    <section id="createSection" class="tabcontent">
        <label>Nombre del curso:</label>
        <input id="nombreCrear" ></input>
        <textarea id="descripcionTxtArea" rows="4" cols="50" ></textarea>
        <button id="btnCrearCurso" name="crearCursoSend">Crear</button>
    </section>

    <section id="editSection" class="tabcontent">
        <section>
            <h2>Editar Nombre de curso</h2>
            <label>Buscar Curso:</label>
            <input id="buscadorCurso" ></input>
        </section>
        <section id="nombreEdit" ></section>
        <section>
            <button id="btnEditCurso" name="editCursoSend">Editar</button>
            <button id="btnVaciarEdit" name="vaciar">Vaciar</button>
        </section>
    <section>
    <table id="tableCursos" class="tabcontent">
        <thead>
            <tr><th>Folio</th><th>Nombre Curso</th></tr>
        </thead>
        <tbody id="tableCursosBody">

        </tbody>
    </table>
</body>
<footer>
    <script type="text/javascript">
    function openSection(evt, sectionName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(sectionName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    jQuery(function() {

        getCursoNombre = function(){
            return document.getElementsByClassName("curso-name")[0].getAttribute('value');
        };
        getCursoEditId = function(){
            return document.getElementsByClassName('curso-name')[0].getAttribute('cursos_id');
        };

        getCursoDescripcion = function(){

            return document.getElementById('editDescripcionTxtArea').value;
        };
        jQuery( "#buscadorCurso" ).autocomplete({
            source: function(request, response) {
                jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/wp-admin/admin-ajax.php' ,
                data: {
    			            action: 'search_curso',
                           q:{                           {
                               nombre: document.getElementById("buscadorCurso").value
                           }
    		    },
                success: function(data) {

                    response(data);
                }
            });
        },
        select: function (event, ui) {

            jQuery("#nombreEdit").html('<label>Nombre Curso:</label><section>Id:('+ui.item.id+')</section><input class="curso-name" cursos_id="'+ui.item.id+'" value="'+ui.item.label+'"></input><textarea id="editDescripcionTxtArea" rows="4" cols="50" >'+ui.item.descripcion+'</textarea><span>');
        }
     });

    jQuery("#btnVaciarEdit").click(function(e){
         e.preventDefault();
         jQuery("#nombreEdit").html('');
    });

jQuery('#btnEditCurso').click( function (e) {
    if(getCursoDescripcion() != ''&& getCursoNombre() != '')
    {
           jQuery(this).attr("disabled", true);
           jQuery.ajax({
               type: 'POST',
               dataType: 'json',
               url: '/wp-admin/admin-ajax.php' ,
               data: {
                           action: 'editar_curso',
                          q: {
                              id: getCursoEditId(),
                              nombre_curso: getCursoNombre(),
                              descripcion: getCursoDescripcion()
                          }
               },
               success: function(data) {
                   alert('Curso Editado con Exito');
               }
           });
           jQuery(this).attr("disabled",false);
    }else
    {
        alert('Necesitas introducir Nombre del curso y descripcion');
    }

 });


jQuery('#btnCrearCurso').click( function (e) {
    if(document.getElementById("descripcionTxtArea").value != ''&& document.getElementById("nombreCrear").value != '')
    {
           jQuery(this).attr("disabled", true);
           jQuery.ajax({
               type: 'POST',
               dataType: 'json',
               url: '/wp-admin/admin-ajax.php' ,
               data: {
                           action: 'crear_curso',
                          q: {
                              nombre_curso: document.getElementById("nombreCrear").value,
                              descripcion: document.getElementById("descripcionTxtArea").value
                          }
               },
               success: function(data) {
                   alert(data);
               }
           });
           document.getElementById("nombreCrear").value = '';
           document.getElementById("descripcionTxtArea").value = '';
           jQuery(this).attr("disabled",false);
    }else
    {
        alert('Necesitas introducir Nombre del curso y descripcion');
    }

 });

      } );
    </script>

</footer>
