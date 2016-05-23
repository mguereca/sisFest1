<?php

/*
 * Vista del Login. SisFest Beta
 * Mod 24-4-2013
 * ing. Manuel Güereca
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest</title>   
        <meta charset="iso-8859-15" />
        <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
    </head>
    <body>
        <div id="cabecera">        
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Sistema para la gestión de festivales culturales.</h2>
            </div>
        </header>
        </div>
        <div id="contenido">    
                <section class="content">
                    <div id="login">  
                    <article>
                         <?php echo validation_errors(); ?>
                   <?php echo form_open('verifylogin'); ?>
                     <!--<label for="username">Login:</label>-->
                     <input type="text" size="20" id="username" name="username" placeholder="Login"/>
                     
                     <br/>
                     <!-- <label for="password">Password:</label> -->
                     <input type="password" size="20" id="password" name="password" placeholder="password"/>
                     
                     <br/>
                     <input type="submit" value="Login"/>
                   </form>
                    </article>
                    </div>
                     <!--<img src="<?php //echo $ruta_imagenes.'icono.png';?>" /> -->
                </section>
               
        </div>  
        
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>