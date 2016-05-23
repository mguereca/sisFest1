<?php
/*
 * Controlador de la parte CRUD de festivales.
 * sisFest Beta
 * mod 16-4-2013
 */

class Festivales extends CI_Controller{
    
    
    
    function __construct() {
        parent::__construct();
        $this->load->model('festivales_model');
        $this->load->helper(array('url','form','MY_form_helper','html'));
        $this->load->library('form_validation');
    }
//------------------------------------------------------------------------------    
    function index(){
        
     if($this->session->userdata('logged_in'))
        {   
        //Si hay festival activado le pasamos los datos a la forma para que se actualicen.
        $data['valores'] = $this->festivales_model->obtener_por_activo();
        $data['festivales'] = $this->festivales_model->obtener_todos();
        
        if((sizeof($data) > 0)&&(sizeof($data['valores'])>0)){
        $this->load->view('festact_view',$data);
        }else{
            $data['festivales'] = $this->festivales_model->obtener_todos();
            $this->load->view('festivales_view',$data);
        }
        
        }
     else
       {
         //If no session, redirect to login page
         redirect('login', 'refresh');
       }
    }//fin de index
//------------------------------------------------------------------------------    
    function nuevo(){
        //Reglas de validación
        $this->form_validation->set_rules('nomFest','Nombre','trim|required|RSS');
        $this->form_validation->set_rules('fechIni','Fecha de Inicio','trim|required');
        $this->form_validation->set_rules('fechFin','Fecha Final','trim|required');
        $this->form_validation->set_rules('generos','Géneros','trim|required');
        $this->mensajes();
        if ($this->form_validation->run() == FALSE){
         //Si hay festival activado le pasamos los datos a la forma para que se actualicen.
            $data['valores'] = $this->festivales_model->obtener_por_activo();
            $data['festivales'] = $this->festivales_model->obtener_todos();
        
            if((sizeof($data) > 0)&&(sizeof($data['valores'])>0)){
                $this->load->view('festact_view',$data);
            }else{
                $data['festivales'] = $this->festivales_model->obtener_todos();
                $this->load->view('festivales_view',$data);
            }   
        //else de la validación de datos    
        }else{
            //datos
        $activo = $this->input->post("activo",TRUE);
         
        if(empty ($activo)){
            $activo = 0;
         }
            
        $datos = array(
            $this->input->post("nomFest",TRUE),
            $this->input->post("fechIni",TRUE),
            $this->input->post("fechFin",TRUE),
            $this->input->post("generos",TRUE),
            $activo
        );
      
        $this->festivales_model->insertar($datos);
        redirect('festivales/');

        }
    }//fin de insertar
    //
//--------------------------------------------------------------------------------    
    function mensajes(){
        $this->form_validation->set_message('required', '%s campo requerido!');
    }
//------------------------------------------------------------------------------    
    function actualizar(){
        //Reglas de validación
        $this->form_validation->set_rules('idFest', 'Festival no identificado!', 'trim|required');
        $this->form_validation->set_rules('nomFest','Nombre','trim|required|RSS');
        $this->form_validation->set_rules('fechIni','Fecha de Inicio','trim|required');
        $this->form_validation->set_rules('fechFin','Fecha Final','trim|required');
        $this->form_validation->set_rules('generos','Géneros','trim|required');
        $this->mensajes();
        //datos
        $activo = $this->input->post("activo",TRUE);
         
        if(empty($activo)){
            $activo = 0;
         }
            
        $datosa = array(
            $this->input->post("nomFest",TRUE),
            $this->input->post("fechIni",TRUE),
            $this->input->post("fechFin",TRUE),
            $this->input->post("generos",TRUE),
            $activo
        );
     
        //---Validación----------------------------------------
        
        $id = $this->input->post("idFest",TRUE);
       
        if ($this->form_validation->run() == FALSE){
            $data['valores'] = $this->festivales_model->obtener_por_activo();
            $data['festivales'] = $this->festivales_model->obtener_todos();
        
            if((sizeof($data) > 0)&&(sizeof($data['valores'])>0)){
            $this->load->view('festact_view',$data);
            }
            
        }else{
            
                $this->festivales_model->actualizar($datosa,$id);
                redirect('festivales/');
               
        }//Fin de la validación
    }//Fin de actualizar
//------------------------------------------------------------------------------    
    function activar(){
          if($this->session->userdata('logged_in'))
            {  
            $id = $this->input->get("id",TRUE);
            $data['val'] = $this->festivales_model->obtener_por_activo();
            
            if((count($data['val']) > 0)AND($data['val'][0]->idFest != $id)){
            
            $this->load->view('erroractualizar_view');
            }else{
            //obtenemos los valores por medio del IDFest
            
            $data['valores'] = $this->festivales_model->obtener_por_id($id);
            $data['festivales'] = $this->festivales_model->obtener_todos();
            if(sizeof($data) > 0){
            $this->load->view('festact_view',$data);
            }else{
                $this->load->view('erroractualizar_view');
            }
        }//fin del else
        
      }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   } //fin de chequeo de session.   
        }//Fin de activar
//------------------------------------------------------------------------------    
}//fin de Festivales Controller

?>