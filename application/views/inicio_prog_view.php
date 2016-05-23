<?php

/*
 * Vista del inicio del usuario programador. SisFest Beta.
 * mod 24-4-2013
 * ing. Manuel Güereca
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Inicio-Programador.</title>   
        <meta charset="iso-8859-15" />
        <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Inicio | Programador. Bienvenido(a) <?php echo $login;?> | Foro: <?php echo $nombref;?></h2>
            </div>           
        </header>
            </div>
        <div id="contenido2">  
        <section>
            <article>
                <div id="menu">
                <ul>
                <li><?php echo anchor('artistas/',"Catálogo de artistas",'');?></li>
                <li><?php echo anchor('programacion/',"Programación",'');?></li>
                <li> <a href="#">Reportes</a>
                    <ul>
                        <li><?php echo anchor('reportes/artistas',"Artistas",'');?></li>
                        <li><?php echo anchor('reportes/art_requi',"Artistas-Requerimientos",'');?></li>
                        <li><?php echo anchor('reportes/programa',"Programa",'');?></li>
                        </ul>
                </li>   
                
                <li><a href="home/logout">Salir</a></li>
            </ul>
               </div> 
            </article>
        </section>
        <aside>
           
        </aside>
        </div>
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>