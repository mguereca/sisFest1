<?php

/*
 * Vista del usuario encargado del foro. SisFest Beta.
 * mod 24-4-2013
 * Ing. Manuel G�ereca
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Inicio-Responsable de Foro.</title>   
        <meta charset="iso-8859-15" />
        <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Inicio | Responsable de Foros. Bienvenido(a) <?php echo $login;?> | Foro: <?php echo $nombref;?></h2>
            </div>            
        </header>
            </div>
        <div id="contenido2">
        <section>
            <article>
                <div id="menu">
                <ul>
                <li><?php echo anchor('reportes/artistas',"Reporte Artistas",'');?></li>
                <li><?php echo anchor('reportes/art_requi',"Reporte Artistas-Requerimientos",'');?></li>
                <li><?php echo anchor('reportes/programa?idf='.$idf,"Reporte Programa",'');?></li>
                <li><a href="home/logout">Salir</a></li>
            </ul>
                </div>
            </article>
        </section>
            
        <aside>
           
        </aside>
            </div>
        <footer>
            Creado por Manuel G�ereca @rezzaca
        </footer>
    </body>
</html>