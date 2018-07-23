<?php

function vxm_forms_alumnos($num_alumno = 0){


    if($num_alumno !== 0){
        $student = vxm_db_get_student($num_alumno);
    } else {
        $student = array();
    }
?>

    <form action="<?php echo admin_url( 'admin-post.php' ); ?>" class="vxm-forms-alumnos" method="POST">
        <div class="grid-bottom">
            <style>
                .vxm-forms-alumnos label{
                    color: #758595;
                    font-weight: bold;
                    display: block;
                    margin-bottom: 13px;
                    font-size: 13px;
                }
                .vxm-forms-alumnos input{
                    background-color: #eceff1;
                    text-transform: uppercase;
                }
                .vxm-forms-alumnos #email {
                    text-transform: none;
                }
                .vxm-forms-alumnos .ui-datepicker {
                    background-color: rgb(40,240,240);
                }
            </style>

            <input type="hidden" name="action" value="vxm_forms_captura_alumnos">
            <input type="hidden" name="post_id" value="new_post">

            <div class="col-4">
                <label>
                    Nombre:
                    <span class="acf-required">*</span>
                </label>
                <input type="text" name="nombres" value="<?php echo $student['nombres']; ?>"  required/>
            </div>

            <div class="col-4">
                <label>
                    Apellidos:
                    <span class="acf-required">*</span>
                </label>
                <input type="text" name="apellidos" value="<?php echo $student['apellidos'];?>"  required/>
            </div>

            <div class="col-4">
                <label>
                    Sexo:
                    <span class="acf-required">*</span>
                </label>

                <select name="sexo" class="browser-default" value="<?php echo $student['sexo'];?>" style="margin-bottom: 15px; background-color: #eceff1">
                    <option value="0">Femenino</option>
                    <option value="1">Masculino</option>
                </select>
            </div>

            <div class="col-3">
                <label>
                    Nombre de Mama:
                    <span class="acf-required">*</span>
                </label>
                <input type="text" name="nombre_mama" value="<?php echo $student['nombre_mama'];?>"  required/>
            </div>

            <div class="col-3">
                <label>
                    País:
                    <span class="acf-required">*</span>
                </label>
                <select 
                    class="browser-default" 
                    name="pais" 
                    data-role="country-selector" 
                    value="<?php echo $student['pais'];?>" 
                    style="margin-bottom: 15px; background-color: #eceff1"></select> 

       
            </div>

            <div class="col-3">
                <label>
                    Estado:
                    <span class="acf-required">*</span>
                </label>
                <input type="text" name="estado" value="<?php echo $student['estado'];?>"  required/>
            </div>

            <div class="col-3">
                <label>
                    Municipio:
                    <span class="acf-required">*</span>
                </label>
                <input type="text" name="municipio" value="<?php echo $student['municipio'];?>"  required/>
            </div>

            <div class="col-4">
                <label>
                    Colonia:
                </label>
                <input type="text" name="colonia" value="<?php echo $student['colonia'];?>" />
            </div>

            <div class="col-4">
                <label>
                    Calle:
                </label>
                <input type="text" name="calle" value="<?php echo $student['calle'];?>" />
            </div>

            <div class="col-4">
                <label>
                    Email:
                    <span class="acf-required">*</span>
                </label>
                <input type="email" name="email" id="email" value="<?php echo $student['email'];?>" required />
            </div>

            <div class="col-3">
                <label>
                    Telefono1:
                    <span class="acf-required">*</span>
                </label>
                <input type="number" name="telefono1" value="<?php echo $student['telefono1'];?>"  required/>
            </div>

            <div class="col-3">
                <label>
                    Telefono2:
                </label>
                <input type="number" name="telefono2" value="<?php echo $student['telefono2'];?>" />
            </div>



            <div class="col-4">
                <label>
                    Fecha de alta:
                    <span class="acf-required">*</span>
                </label>
                <input type="text" name="fecha_alta" value="<?php echo $student['fecha_alta'];?>" id="datepicker" />
            </div>

            <div class="col-2">
                <label>Número de instructor:</label>
                <?php
                    if($num_alumno === 0){
                        $num_instructor = get_current_user_id();
                    } else {
                        $num_instructor = $student['num_instructor'];
                    }
                ?>
                <input type="number" name="num_instructor" value="<?php echo $num_instructor;?>" />
            </div>  


            <a href="javascript:void(0)" class="btn-flat" onclick="$.magnificPopup.close();">Cancelar</a>

            <button class="btn" type="submit">
                Enviar
            </button>








        </div>
        

        

    </form>


    <script>


        $( function() {
                $( "#datepicker" ).datepicker({
                    dateFormat: 'dd/mm/yy'
                });

                if( $('body > #ui-datepicker-div').exists() ) {
                    $('body > #ui-datepicker-div').wrap('<div class="acf-ui-datepicker" />');
                }

                $("select[data-role=country-selector]").countrySelector();

            } 
        );
    </script>
    <?php


}
// wp_register_script( 'vxm-forms-countryselector-js', plugin_dir_url( __FILE__ ) . 'assets/countrySelector/js/jquery.countrySelector.js', array( 'jquery' ), '5.1.1', true );
// wp_dequeue_script( 'vxm-forms-countryselector-js');
// add_action('wp_enqueue_scripts', 'vxm_forms_enqueue_scripts_template');
// function vxm_forms_enqueue_scripts_template() {   
    // wp_register_script( 'vxm-forms-main', plugin_dir_url( __FILE__ ) . 'assets/js/vxm-forms-main.js', array( 'jquery' ), '5.1.1', true );
    // wp_enqueue_script( 'vxm-forms-main' );

    // wp_register_script( 'vxm-forms-countryselector-js', plugin_dir_url( __FILE__ ) . 'assets/countrySelector/js/jquery.countrySelector.js', array( 'jquery' ), '5.1.1', true );
    // wp_enqueue_script( 'vxm-forms-countryselector-js' );
    // wp_dequeue_script( 'vxm-forms-countryselector-js');

    // wp_enqueue_style( 'vxm-forms-countryselector-css', plugin_dir_url( __FILE__ ) . 'assets/countrySelector/css/jquery-countryselector.css');
// }

// wp_enqueue_script( 'vxm-forms-countryselector-js' );

?>




