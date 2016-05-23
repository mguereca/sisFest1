<?php

/*
 * Vista de Festivales. sistFest Beta
 * 27/03/2013
 * mod 24-4-2013
 * Ing. Manuel Güereca
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Catálogo-Festivales.</title>   
        <meta charset="iso-8859-15" />
       <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Catálogo-Festivales.</h2>
            </div>
        </header>
            </div>
        <div id="contenido">
        <section>
            <article>             
                <?php
                echo form_open_multipart('festivales/nuevo');
                ?>
                <div id="formulario">
                   <fieldset>
                        <legend>Nuevo Festival</legend> 
               
                
                    <?php
                    
                    //parte para lo del logo del festival. Pendiente.
                    //echo form_label("FOTO: ");
                    //echo form_input(array('name'=>'foto'));
                    //echo '<input type="file" name="userfile" accept="image/*" capture="camera"></input>';
                    
                    echo form_label('Nombre: ');
                    echo form_input(array('name'=>'nomFest','size'=>50));
                    echo form_error('nomFest');
                    echo form_label('Fecha de Inicio: ');
                    echo form_date('fechIni');
                    echo form_error('fechIni');
                    echo form_label('Fecha Final: ');
                    echo form_date('fechFin');
                    echo form_error('fechFin');
                    echo form_label('Géneros: ');
                    echo form_input(array('name'=>'generos','value'=>'Música, Teatro, Danza, Cine, Pintura, Literatura','size'=>50));
                    echo form_error('generos');
                    echo form_label('Activo: ');
                    echo form_checkbox('activo', '1', TRUE);
                    echo form_error('activo');
                    echo form_hidden('idFest');
                    
                    echo '<br /><br />';
                    
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
            <h3>Selecciona para editar.</h3>
            <ul>
            <?php
                   
            if(sizeof($festivales) >= 1){
            foreach ($festivales as $fila) {
                //echo '<li>'.anchor('resina/mostrar?id='.$fila->idRes,'Producto'.$fila->idRes,'').'</li>';
                echo '<li>'.anchor('festivales/activar?id='.$fila->idFest,$fila->nomFest,'').'</li>';
                
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