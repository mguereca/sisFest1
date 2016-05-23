<?php

/*
 * Vista principal del manejo de artistas.
 * Sisfet Beta 3-25-2013
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Catálogo-Artistas.</title>   
        <meta charset="iso-8859-15" />
  <?php        include 'rutas_config.php'?>
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
                <div id="tabla">
                <table width="80%">
                    <thead>
                    
                    <tr>
                        <td>Nombre del Artísta</td>
                        <td>Categoría</td>
                        <td>Teléfono</td>
                        <td>E-mail</td>
                        <td>Eliminar</td>
                        <td>Editar</td>
                      
                    </tr>
                 
                 </thead>
                <?php 
                if(sizeof($artistas)>=1){
                    foreach ($artistas as $value) {                                        
                ?>
                    <tr>
                        <td><img src="<?php echo base_url();?>uploads/thumbs/<?php echo $value->foto;?>" /></td>
                        <td><?php echo $value->nombrea;?></td>
                        <td>
                        <?php 
                            switch ($value->categoria){
                                case 'MUS':
                                    echo 'Música';
                                    break;
                                case 'CIN':
                                    echo 'Cine';
                                    break;
                                case 'TEA':
                                    echo 'Teatro';
                                    break;
                                case 'LIT':
                                    echo 'Literatura';
                                    break;
                                case 'DAN':
                                    echo 'Danza';
                                    break;
                                case 'PLA':
                                    echo 'Plástica';
                                    break;
                            }//fin del switch()
                        ?>
                        </td>    
                    
                    <td><?php echo $value->telefono;?></td>
                    <td><?php echo $value->email;?></td>
                    <td><?php echo anchor('artistas/eliminar?ida='.$value->ida,'Eliminar','');?></td>
                    <td><?php echo anchor('artistas/modificar?ida='.$value->ida,'Editar','');;?></td>
                    
                    </tr>
              <?php 
                    }//fin del foreach
                }//fin del if 
              ?>          
                </table>
                    </div>
                
                <p><?php echo $links; ?></p>
                <p>
                    Página rendereada en <strong>{elapsed_time} segundos.</strong>
                </p>
            </article>
                 <div id="boton2">
           <?php echo anchor('artistas/agregar','Nuevo','');?>
        </div>
            <div id="boton">
                <?php echo anchor('home/',"Inicio",''); ?>
                </div>
          </section>
        </div>     
        
           
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>
