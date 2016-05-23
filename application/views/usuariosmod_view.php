<?php

/*
 * Vista para la eliminación o modificación de usuarios.
 * sisFest Beta
 * 28/03/2013
 * mod 24-4-2013 Ing. Manuel Güereca
 */

if(sizeof($foros) >= 1){
$f = array();
foreach ($foros as $value) {
  $f[$value->idf] = $value->nombref; 
}
}

if(isset ($idf)){
    foreach ($idf as $value) {
        $seleccionar = $value;
    }
}else{
    
    $seleccionar = key($f);
}    


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Catálogo-Usuarios.</title>   
        <meta charset="iso-8859-15" />
       <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Catálogo-Usuarios.</h2>
            </div>           
        </header>
            </div>
        <div id="contenido2">
        <section>
            <article>
                
                <?php
                echo form_open_multipart('usuarios/actualizar');
                ?>
               
                <div id="formulario2">
                     <fieldset>
                        <legend>Editar/Eliminar Usuarios</legend> 
                <?php
                    
                foreach ($valores as $datos){
                    
                    echo form_label('Nombre: ');
                    echo form_input(array('name'=>'nombreu','value'=>$datos->nombreu,'size'=>50));
                    echo form_error('nombreu');
                    echo form_label('E-mail: ')."</td>";
                    echo form_input(array('name'=>'email','value'=>$datos->email,'size'=>50));
                    echo form_error('email');
                    echo form_label('Login: ')."</td>";
                    echo form_input(array('name'=>'login','value'=>$datos->login));
                    echo form_error('login');
                    //-----------Se deberá resetear el password--------------------
                   
                    echo form_label('Password: ');
                    echo form_password(array('name'=>'password'));
                    echo form_error('password');
                    echo form_label('Verifica el Password: ');
                    echo form_password(array('name'=>'passwordv'));
                    echo form_error('passwordv');
                    //-------------------------------------------------------------
                            $r1 = FALSE;
                            $r2 = FALSE;
                            $r3 = FALSE;
                    switch ($datos->tipo){
                        
                        case 1:
                            $r1 = TRUE;
                            break;
                        case 2:
                            $r2 = TRUE;
                            break;
                        case 3:
                            $r3 = TRUE;
                            break;
                    }
                   
                    echo "<div class='radio-tool2'>";
                    echo "<fieldset>";
                    echo "<legend>Tipo de Usuario</legend> ";
                    echo form_radio('tipo','1',$r1);
                    echo form_label('Administrador | ','tipo');
                    
                    echo form_radio('tipo','2',$r2);
                    echo form_label('Programador | ','tipo');
                    
                   echo form_radio('tipo','3',$r3);
                    echo form_label('Responsable de foro ','tipo');
                    
                    echo form_error('tipo');
                    echo "</fieldset>";
                    echo "</div>";
                    echo "<div class='radio-tool2'>";
                    echo form_label('Foro: ');
                    echo form_dropdown('idf',$f,$seleccionar);
                    echo form_error('idf');
                    echo form_label('Eliminar: ');
                    echo form_checkbox('eliminar','true');
                    echo form_hidden('idu',$datos->idu);
                    echo "</div>";
                }//fin foreach
                   echo "<BR /><BR />";
                   
                   $control = array(
                           'id'=>'btnEnviar',
                           'name'=>'Enviar',
                           'value'=>'Enviar Datos!'
                       );  
                echo form_submit($control);
                  
                    echo form_close();
                    ?>
                 </fieldset>
               </div>
            </article>
        </section>
            </div>
        <div id="ver">
        <aside>
             <p>
                Si edita el usuario, tendrá que reescribir el password en caso
                de que se requiera el mismo. De lo contrario hay que poner uno nuevo,
                en caso de que el usuario pierda su password.
                </p>
                <p>
                    Si desea eliminar al usuario, elija "Eliminar" en la forma y dele click en "Enviar Datos". 
                    La validación del formulario exige escribir el password no importando si elige la opción "Eliminar".
                </p>
        </aside>
            </div>
         <div id="boton">
                <?php echo anchor('home/',"Inicio",''); ?>
                </div>
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>