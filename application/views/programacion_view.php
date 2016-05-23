<?php

/*
 * Vista de la programación
 * sisFest Beta
 * 31/03/2013
 * Creado por Ing. Manuel Güereca
 */
$session_data = $this->session->userdata('logged_in');
$art = array();
foreach ($artistas as $value) {
    $art[$value->ida] = $value->nombrea;
}
$afech = array(
    "min"=>$session_data['fechIni'],
    "max"=>$session_data['fechFin']
);

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Programación del Festival.</title>   
        <meta charset="iso-8859-15" />
       <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
       
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Programación de los artistas. Foro: <?php echo $session_data['nombref'];?></h2>
            </div>
        </header>
            </div>
        <div id="contenido3">
        <section>
            <article id="prog">
                 <?php echo validation_errors(); ?>
                <?php
                echo form_open_multipart('programacion/nuevo');
                ?>
                
               
                    Día:
                    <input type="date" name="fecha" min="<?php echo $session_data['fechIni'];?>" max="<?php echo $session_data['fechFin'];?>" value="<?php echo $session_data['fechIni'];?>" required="required"/>
                <?php  //echo form_date('fecha','',$afech); 
                    echo form_hidden('idf',$session_data['idf']);?>
                    Hora:<input type="time" name="hora"/>
                    Artista:<?php echo form_dropdown('artista',$art);?>
                   <?php 
                   $control = array(
                           'id'=>'btnEnviar',
                           'name'=>'Enviar',
                           'value'=>'Enviar Datos!'
                       );  
                   echo form_submit($control);?>
                 
               <?php echo form_close();?>
                    <hr />
            </article>
            
            <article>
                <div id="tabla">
                <table border ="1" width="80%">
                    <tr>
                       <td>Día</td>
                       <td>Hora</td>
                       <td>Artista</td>
                       <td>Eliminar</td>
                    </tr>
                <?php    
                    if(isset($lista)){
                        foreach ($lista as $value) {
                            
                        
                   ?>     
                    <tr>
                       <td><?php echo $value->dia;?></td>
                       <td><?php echo $value->hora;?></td>
                       <td><?php echo $art[$value->artistas_ida];?></td>
                       <td><?php echo anchor('programacion/eliminar?idp='.$value->idp,'Eliminar','');?></td>
                    </tr>
                 <?php   
                    } //fin del foreach
                    }else{
                        ?>
                        <tr>
                       <td>----</td>
                       <td>----</td>
                       <td>-----</td>
                       <td>-----</td>
                    </tr>
                  <?php  
                    }//fin del else
                 ?>   
                    
                </table>
                    </div>
            </article>
        </section>
             <div id="boton">
                <?php echo anchor('home/',"Inicio",''); ?>
                </div>
        </div>
       
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>