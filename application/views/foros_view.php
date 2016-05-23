<?php

/*
 * Vista de los foros. SisFest Beta.
 * mod 24-4-2013
 * Ing. Manuel Güereca
 * 
 */

if(sizeof($fest) >= 1){
    foreach ($fest as $value) {
        $idFest = $value->idFest;
        $nomFest = $value->nomFest;
   
    }
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
                <h2>Catálogo-Foros. <?php echo $nomFest;?></h2>
            </div>
        </header>
            </div>
        <div id="contenido">
        <section>
            <article>
               
                <?php
                echo form_open_multipart('foros/nuevo');
                ?>
                <div id="formulario">
                    <fieldset>
                        <legend>Nuevo foro</legend>
                    
               
                
                
                <?php
                    
                    
                    echo form_label('Nombre del Foro: ');
                    echo form_input(array('name'=>'nombref','size'=>50));
                    echo form_error('nombref');
                    echo form_label('Ubicación: ');
                    echo form_input(array('name'=>'ubicacion','size'=>50));
                    echo form_error('ubicacion');
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
        <aside>
            </div>
        <div id="ver">
           <p>
            <h3>Click para editar o eliminar</h3>
            <ul>
            <?php
            
            if(isset ($foros) && sizeof($foros) >= 1){
            foreach ($foros as $fila) {
                //echo '<li>'.anchor('resina/mostrar?id='.$fila->idRes,'Producto'.$fila->idRes,'').'</li>';
                echo '<li>'.anchor('foros/modificar?id='.$fila->idf,$fila->nombref,'').'</li>';
                //echo '<li>'.$fila->idf.$fila->nombref.$fila->ubicacion.'</i>';
            }
            }else{
                echo '<li>No hay datos</li>';
            }
            ?>
                </ul>
            
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