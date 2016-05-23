<?php

/*
 * Controlador de la relación de la programación de los artistas en los foros.
 * sisFest Beta 31/03/2013
 * Creado por Ing. Manuel Güereca
 * mod 16-4-2013
 */

class Programacion extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('artistas_model','art');
        $this->load->model('programacion_model','prog');
        $this->load->helper(array('url','form','MY_form_helper','html'));
        $this->load->library('pagination');
        $this->load->helper('array');
        $this->load->library('form_validation');

    }
//--------------------------------------------------------------    
    function index(){
        if($this->session->userdata('logged_in'))
     { 
            $session_data = $this->session->userdata('logged_in');
            $data['artistas'] = $this->art->obtener_lista();
            $data['lista'] = $this->prog->obtener_lista($session_data['idf']);
            $this->load->view('programacion_view',$data);
     }
    else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
}//fin de index
//---------------------------------------------------------------
    function nuevo(){
        $this->form_validation->set_rules($this->reglas());
        $this->mensajes();
        
        if ($this->form_validation->run() == FALSE){
               if($this->session->userdata('logged_in'))
     { 
            $session_data = $this->session->userdata('logged_in');
            $data['artistas'] = $this->art->obtener_lista();
            $data['lista'] = $this->prog->obtener_lista($session_data['idf']);
            $this->load->view('programacion_view',$data);
     }
    else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
            
        }else{
            
             $this->prog->insertar();
            redirect('programacion/');
        }//fin del else de las validaciones.
       
        
    }
//----------------------------------------------------------------
    function eliminar(){
        $idp = $this->input->get('idp',TRUE);
        $this->prog->elimina($idp);
        redirect('programacion/');
    }
    
//-----------------------------------------------------------------
    private function reglas(){
        $reglas = array(
            array(
                     'field'   => 'fecha',
                     'label'   => 'Fecha',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'hora',
                     'label'   => 'Hora de Presentación',
                     'rules'   => 'required|trim|RSS'
                  ),
            array(
                     'field'   => 'artista',
                     'label'   => 'Seleccione un Artista',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'idf',
                     'label'   => 'Número de foro no identificado.',
                     'rules'   => 'required|RSS|trim'
                  )
        );
        return $reglas;
    }
    
//------------------------------------------------------------------------------
    function mensajes(){
        $this->form_validation->set_message('required', '%s campo requerido!');
        }
} //fin del controlador
?>