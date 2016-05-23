<?php

/*
 * Vista principal del manejo de artistas.
 * Sisfet Beta 3-25-2013
 * mod 29/03/2013 validación de formulario
 * mod 4-16-2013
 * Ing. Manuel Güereca
 */

//----Definición de categorias---//
$categorias = array(
    'MUS'=>'Música',
    'CIN'=>'Cine',
    'TEA'=>'Teatro',
    'LIT'=>'Literatura',
    'DAN'=>'Danza',
    'PLA'=>'Plástica'
);

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Catálogo-Artistas.</title>   
        <meta charset="iso-8859-15" />
        <?php include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Catálogo-Artistas.</h2>
            </div>           
        </header>
            </div>
        <div id="contenido3">
        <section>
            <article>
                
                <?php
                echo form_open_multipart('artistas/nuevo');
                ?>
                <div id="formulario3">
                    <fieldset> 
                        <legend>Nuevo Artista</legend>
                              
                        <?php echo form_label('Nombre del Artista: ');?>
                        <?php echo form_input(array('name'=>'nombrea','size'=>'50'));?>
                        <?php echo form_error('nombrea'); ?>
                        <?php echo form_label('Nombre del Representante: ');?>
                        <?php echo form_input(array('name'=>'nombrerep','size'=>'50'));?>
                        <?php echo form_error('nombrerep'); ?>
                        <?php echo form_label('Honorarios: ');?>
                        <?php echo form_input(array('name'=>'honorarios'));?>
                        <?php echo form_error('honorarios'); ?>
                        <?php echo form_label('Teléfono: ');?>    
                        <?php echo form_input(array('name'=>'telefono'));?>    
                        <?php echo form_error('telefono'); ?>
                        <?php echo form_label('Celular: ');?>    
                        <?php echo form_input(array('name'=>'celular'));?>    
                        <?php echo form_error('celular'); ?>
                        <?php echo form_label('E-mail: ');?>    
                        <?php echo form_input(array('name'=>'email','size'=>'30'));?>    
                        <?php echo form_error('email'); ?>
                        <?php echo form_label('Página Web: ');?>    
                        <?php echo form_input(array('name'=>'pweb'));?>    
                        <?php echo form_label('Foto: ');?>       
                        <input type="file" name="userfile" size="20" />
                        <?php 
                        if(isset ($error))
                            echo $error;
                        ?>
                        <?php echo form_label('Categoría: ');?>    
                        <?php echo form_dropdown('categoria',$categorias,'MUS');?>
                        <?php echo form_error('categoria'); ?>
                </fieldset>
                </div>  
               
                <div id="formulario4">  
                    <fieldset>
                        <legend>Requerimientos</legend>
                    <?php echo form_error('esp[]'); ?>
                    <?php
                     foreach ($especificaciones as $key => $value) {               
                    ?>
                     
                           <div class='radio-tool'>   
                         <?php
                         echo form_checkbox('esp[]', $key); 
                         echo form_label($value);
                         ?>
                           
                           
                       
                                <?php echo form_input(array('name'=>'cantidad[]','placeholder'=>'cantidad')); ?>
                            
                           
                            <?php echo form_input(array('name'=>'costo[]','placeholder'=>'costo')); ?>   
                      
                    <?php 
                    
                    }//Fin del Foreach de Especificaciones
                    
                    ?>
                     </div>
                <?php
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
     <div id="boton">
                <?php echo anchor('home/',"Inicio",''); ?>
                </div>
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>