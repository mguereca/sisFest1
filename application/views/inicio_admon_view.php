<?php

/*
 * Vista del usuario administrador. SisFest Beta.
 * mod 24-4-2013
 * mod 28-8-2013
 * Ing. Manuel Güereca
 */
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Inicio-Administración del Sistema.</title>   
        <meta charset="iso-8859-15" />
        <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo">
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
            
            
            <h2>Inicio | Administración del sistema. Bienvenido(a) <?php echo $login;?></h2>
            </div>
            
        </header>
            </div>
        <div id="contenido2"> 
            <div id="menu">
        <section>
            <article>
                <ul>
                <li><?php echo anchor('festivales/',"Festivales",'');?></li>
                <li><?php echo anchor('foros/',"Foros",'');?></li>
                <li><?php echo anchor('usuarios/',"Usuarios",'');?></li>
                <li><a href="home/logout">Salir</a></li>
            </ul>
                
            </article>
        </section>
                </div>
        <aside>

        </aside>
        </div>
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>