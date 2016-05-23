<?php

/*
 * Reporte de Artistas
 * sisFest Beta
 * 02/04/2013 @rezzaca
 */

//$session_data = $this->session->userdata('logged_in');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Reporte de Artistas.</title>   
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
                <h2>Reporte de artistas.</h2>
            </div>
        </header>
            </div>
        <section>
            
            <article>
                <div id="tabla">
                <table width="80%">
                    <thead>
                    <tr>
                        <td>Foto</td>
                        <td>Artísta/Repr.</td>
                        <td>Honorarios</td>
                        <td>Teléfono</td>
                        <td>Celular</td>
                        <td>E-mail</td>
                        <td>Página Web</td>
                        <td>Categoría</td>                     
                    </tr>
                 </thead>
                <?php 
                if(sizeof($artistas)>=1){
                    foreach ($artistas as $value) {                                        
                ?>
                    <tr>
                        <td><img src="<?php echo base_url();?>uploads/thumbs/<?php echo $value->foto;?>" /></td>
                        <td><?php echo $value->nombrea.'/ '.$value->nombrerep;?></td>
                        <td>$<?php echo $value->honorarios;?></td>
                        <td><?php echo $value->telefono;?></td>
                        <td><?php echo $value->celular;?></td>
                        <td><?php echo $value->email;?></td>
                        <td><?php echo $value->pweb;?></td>
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
                    
                    
                    </tr>
              <?php 
                    }//fin del foreach
                }//fin del if 
              ?>          
                </table>
                    </div>
                <br/>
                <div id="boton">
                <a href="javascript:history.back()">Regresar</a>
                </div>
                <hr/>
            </article>
        </section>
        
        
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>