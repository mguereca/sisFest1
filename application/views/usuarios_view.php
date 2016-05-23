<?php

/*
 * Vista principal del manejo de usuarios.
 * sisFest Beta
 * 28/03/2013
 * 
 */
if(sizeof($foros) >= 1){
$f = array();
foreach ($foros as $value) {
  $f[$value->idf] = $value->nombref; 
}
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>SisFest: Catálogo-Usuarios.</title>   
        <meta charset="iso-8859-15" />
               <?php        include 'rutas_config.php'?>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_estilos;?>" />
        
    </head>
    <body>
        <div id="cabecera">
        <header>
            <div id="logo"> 
                <img src="<?php echo $ruta_imagenes.'logo.png';?>" />
                <h2>Catálogo-Usuarios.</h2>
            </div>          
        </header>
            </div>
        <div id="contenido2">  
        <section>
            <article>
                

                <?php
                echo form_open_multipart('usuarios/nuevo');
                ?>
                <div id="formulario2">
                     <fieldset>
                        <legend>Nuevo Usuario</legend> 
               
                
                
                <?php
                    
                    
                    echo form_label('Nombre: ');
                    echo form_input(array('name'=>'nombreu','size'=>50));
                    echo form_error('nombreu');
                    echo form_label('E-mail: ');
                    echo form_input(array('name'=>'email','size'=>50));
                    echo form_error('email');
                    echo form_label('Login: ')."</td>";
                    echo form_input(array('name'=>'login'));
                    echo form_error('login');
                    echo form_label('Password: ')."</td>";
                    echo form_password(array('name'=>'password'));
                    echo form_error('password');
                    echo form_label('Verifica el Password: ');
                    echo form_password(array('name'=>'passwordv'));
                    echo form_error('passwordv');
                    echo "<div class='radio-tool2'>";
                    echo "<fieldset>";
                    echo "<legend>Tipo de Usuario</legend> ";
                    echo form_radio('tipo','1');
                    echo form_label('Administrador | ');
                    echo form_radio('tipo','2');
                    echo form_label('Programador | ');
                    echo form_radio('tipo','3');
                    echo form_label('Responsable de foro | ');
                    echo form_error('tipo');
                    echo "</fieldset>";
                    echo "</div>";
                    echo form_label('Foro: ');
                    echo form_dropdown('idf',$f);
                    echo form_error('idf');
                    echo "<br/><br/>";
                    $control = array(
                           'id'=>'btnEnviar',
                           'name'=>'Enviar',
                           'value'=>'Enviar Datos!'
                       );  
                    echo form_submit($control);
                    
                    echo form_close();
                    ?>
                   
                
                </fieldset>
               </div>
            </article>
        </section>
            
        </div>
        <div id="ver">
        <aside>
           <p>
            <h3>Click para editar o eliminar</h3>
            <ul>
            <?php
            
            if(sizeof($usuarios) >= 1){
            foreach ($usuarios as $fila) {
                switch($fila->tipo){
                    case 1:
                        $tipo = "Administrador";
                        break;
                    case 2:
                        $tipo = "Programador";
                        break;
                    case 3:
                        $tipo = "Responsable de foro";
                        break;
                }
                echo '<li>'.anchor('usuarios/modificar?idu='.$fila->idu,$fila->nombreu,'').'('.$tipo.')</li>';
                
            }
            }else{
                echo '<li>No hay datos</li>';
            }
            
            ?>
                </ul>
            
            </p>
        </aside>
            </div>
        <div id="boton">
                <?php echo anchor('home/',"Inicio",''); ?>
                </div>
        <footer>
            Creado por Manuel Güereca @rezzaca
        </footer>
    </body>
</html>