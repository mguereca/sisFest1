<?php

/*
 * Reporte de todos los requerimientos de todos los artistas.
 * sisFest Beta.
 * 02/04/2013
 * Ing. Manuel Güereca @rezzaca
 */



$art = array();
foreach ($lista as $value) {
    $art[$value->ida] = $value->nombrea;
}

$esp = array(
            'BA'=>'Boletos de Avión',
            'BT'=>'Boletos Terrestre',
            'AU'=>'Autobús',
            'SU'=>'Suburban',
            'VE'=>'Van Express',
            'VC'=>'Van de Carga',
            'HO'=>'Hospedage',
            'VI'=>'Viáticos',
            'CA'=>'Camerinos',
            'CT'=>'Catering',
            'PE'=>'Permisos',
            'RI'=>'Rider',
            'SE'=>'Seguridad',
            'SG'=>'Seguro',
            'MT'=>'Montage'
        );


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Reporte de Artistas Requerimientos.</title>   
        <meta charset="iso-8859-15" />
       <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_imprimir;?>" media="print" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Reporte de requerimientos de los artistas.</h2>
            </div>
        </header>
            </div>
        <section>
            <article>
                 
                 <div id="tabla">
                <table width="80%">
                    <thead>
                    <tr>
                        <td>Artista</td>
                        <td>Especificación</td>
                        <td>Cantidad</td>
                        <td>Costo</td>
                    </tr>
                    </thead>
                 <?php
                 if(sizeof($requi)>1)
                 foreach ($requi as $value) {
                 ?>
                    <tr>
                        <td><?php echo $art[$value->artistas_ida];?></td>
                        <td><?php echo $esp[$value->especificacion];?></td>
                        <td><?php echo $value->cantidad;?></td>
                        <td>$<?php echo $value->costou;?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </table>
                 </div>
                 <div id="boton">
                <a href="javascript:history.back()">Regresar</a>
                </div>
            </article>
            <hr />
           
        </section>
        
        
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>