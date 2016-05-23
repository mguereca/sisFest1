<?php

/*
 * Reporte de la programación del festival.
 * sisFest Beta.
 * 02/04/2013
 * mod 24-4-2013 ing. Manuel Güereca
 * mod 17-5-2013 ing. Manuel Güereca
 */

if(sizeof($foros)>0){
$f = array();

foreach ($foros as $value) {
    $f[$value->idf] = array(
        "nombref" => $value->nombref,
        "ubicacion" => $value->ubicacion
    );
}
}



if(sizeof($artistas)>0){
    $art=array();
foreach ($artistas as $value) {
    switch ($value->categoria){
        case 'MUS':
            $cat = 'Música';
            break;
        case 'CIN':
            $cat ='Cine';
            break;
        case 'TEA':
            $cat = 'Teatro';
            break;
        case 'LIT':
            $cat = 'Literatura';
            break;
        case 'DAN':
            $cat ='Danza';
            break;
        case 'PLA':
            $cat = 'Plástica';
            break;
    }//fin del switch()
    
    $art[$value->ida] = array(
        "nombre"=>$value->nombrea,
         "foto"=>$value->foto,
        "categoria"=>$cat
        );
}
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Programación del Festival.</title>   
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
                <h2>Programa.</h2>
            </div>
        </header>
            </div>
        <section>
            <article>
                <div id="tabla">
                <table width="80%">
                    <thead>
                    <tr>
                        <td>Fecha</td>
                        <td>Hora</td>
                        <td>Artista</td>
                        <td>Categoría</td>
                        <td>Foro</td>
                    </tr>
                    </thead>
                    <?php  foreach ($programa as $value) { ?>
                    <tr>
                        <td><?php echo $value->dia;?></td>
                        <td><?php echo $value->hora;?></td>
                        <td>
                            <img src="<?php echo base_url();?>uploads/thumbs/<?php echo $art[$value->artistas_ida]['foto'];?>" />
                        <?php
                        echo $art[$value->artistas_ida]['nombre'];
                        ?>
                        </td>
                        <td><?php echo $art[$value->artistas_ida]['categoria'];?></td>
                        <td><?php echo $f[$value->foros_idf]['nombref'].".".$f[$value->foros_idf]['ubicacion']?></td>
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
            <article>
            </article>
        </section>
        
        <aside>
          
        </aside>
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>