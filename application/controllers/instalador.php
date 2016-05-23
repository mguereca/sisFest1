<?php

/*
 * Controlador del Instalador. sisFestBeta
 * Ing. Manuel G�ereca
 * 17-4-2013
 * mod 23-4-2013
 * mod 24-4-2013
 */

class Instalador extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->config->load('config',TRUE);
        $this->load->model('usuarios_model','usua');
        $this->load->model('festivales_model','fest');
        $this->load->model('foros_model','foros');
        $this->load->model('tiene_model','tiene');
    }
    
    function index(){
        //Muestra la vista con la informaci�n para levantar la base de datos del sistema.
        //$data["bd"] = $this->config->item('language');
        //Creamos un usuario administrador
        
        if($this->usua->usuario_admon()){
        
        $data["mensaje"] = "El usuario Administrador ha sido creado!";
        }else{
            $data["mensaje"] = "Error en la creaci�n del usuario Administrador!";
        }
        
        //Creamos un festival de muestra
        $f = array(
            'Festival Internacional Cervantino',
            '2013-10-09',
            '2013-10-27',
            'M�sica, Teatro, Danza, Cine, Pintura, Literatura',
            1
        );
        
        $this->fest->insertar($f);
        
        $data["mensaje2"] = "Festival Creado....";
        //-------------------------------------------------------
        //Creamos un foro
        //Sacamos el id del festival activo.
        $festival = $this->fest->obtener_id_nombre();
        if(sizeof($festival) >= 1){
            foreach ($festival as $value) {
            $idFest = $value->idFest;
            }
        }
        
        $foro = array(
            'Sal�n del Consejo Universitario',
            'Guanajuato'
        );
        
        $idf = $this->foros->insertar($foro);
        
        //relaci�n tiene
        
        $t = array(
            $idFest,
            $idf
        );
        $data["mensaje3"] = "Foro Creado....";
        $this->tiene->insertar($t);
        $data["mensaje4"] = "Relaci�n entre Foros y Festivales Creado....";
       
        
        $this->load->view('instalador_view',$data);
        
        
    }
    
    function instalando(){
        //funci�n principal de la creaci�n de la base de datos.
    }
    
    function terminado(){
        //Muestra la vista de �xito o fracaso en la instalaci�n.
    }
}
?>