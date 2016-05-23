<?php

/*
 * Nota al 12/04/2012
 * Vista de error general al tratar de actualizar un festival y que está otro activado.
 * Vista Error. SisFest Beta.
 * mod 24-4-2013
 * Ing. Manuel Güereca
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Catálogo-Festivales-ERROR.</title>   
        <meta charset="iso-8859-15" />
       <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Catálogo-Festivales-ERROR.</h2>
            </div>
           
            
        </header>
            </div>
        <div id="contenido">
        <section>
            <article>
                
                <h1>ERROR: Al tratar de activar este festival. Ya existe un festival activado.</h1>
                <h4>Si deseas activar otro festival, tienes que desactivar el festival actual.</h4><br/>
                <h4><?php echo anchor('festivales/','<< Regresar al catálogo de Festivales!');?></h4>
                </p>
            </article>
        </section>
            </div>
        <aside>
            
        </aside>
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>