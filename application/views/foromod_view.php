<?php

/*
 * Vista para modificar o eliminar de la lista de foros. SisFest Beta.
 * mod 24-4-2013
 * Ing. Manuel Güereca
 */
foreach ($fest as $value) {
    $nomFest = $value->nomFest;
    $idFest = $value->idFest;
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Catálogo-Foros.</title>   
        <meta charset="iso-8859-15" />
               <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Catálogo-Foros Modificar/Eliminar. <?php echo $nomFest;?></h2>
            </div>
        </header>
            </div>
        <div id="contenido">
        <section>
            <article>
                 
                <?php
                echo form_open_multipart('foros/actualizar');
                ?>
                <div id="formulario">
                    <fieldset>
                        <legend>Modificar/Eliminar Foro</legend>
                
                
                
                <?php
                foreach ($valores as $datos){
                    
                    echo form_label('Nombre del Foro: ');
                    echo form_input(array('name'=>'nombref','value'=>$datos->nombref,'size'=>50));
                    echo form_error('nombref');
                    echo form_label('Ubicación: ');
                    echo form_input(array('name'=>'ubicacion','value'=>$datos->ubicacion,'size'=>50));
                    echo form_error('ubicacion');
                     echo "<div class='radio-tool'>";
                     echo form_label('Eliminar: ');
                    echo form_checkbox('eliminar','true');
                    echo "</div>";
                    echo form_hidden('idf',$datos->idf);
                }
                    echo form_hidden('idFest',$idFest);
                    
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
        <aside>
          
        </aside>
        <div id="boton">
                <?php echo anchor('home/',"Inicio",''); ?>
                </div>
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>