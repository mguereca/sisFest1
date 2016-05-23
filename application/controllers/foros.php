<?php

/*
 * Controlador de la parte CRUD de foros.
 * sisFest Beta
 * 28/03/2013
 * mod 16-4-2013
 * mod 2-5-2013
 */

class Foros extends CI_Controller{
    
   
    
    function __construct() {
        parent::__construct();
        $this->load->model('foros_model','foros');
        $this->load->model('festivales_model','fest');
        $this->load->model('tiene_model','tiene');
        $this->load->helper(array('url','form','MY_form_helper','html'));
        $this->load->library('form_validation');
    }
    //-------------------------------------------------------------------
    private function reglas(){
        
        $reglas = array(
            
        array(
            'field'=>'nombref',
            'label'=>'Nombre del Foro',
            'rules'=>'trim|required|RSS'
        ),
        array(
            'field'=>'ubicacion',
            'label'=>'Ubicación del Foro',
            'rules'=>'trim|required|RSS'
        ),
        array(
            'field'=>'idFest',
            'label'=>'La forma no identifica al festival!',
            'rules'=>'trim|required|RSS|integer'
        )
        
    );
        
        return $reglas;
    }
    
    //---------------------------------------------------------------------------
    
      function mensajes(){
        $this->form_validation->set_message('required', '%s campo requerido!');
    }

    //--------------------------------------------------------------------
    
    function index(){
      if($this->session->userdata('logged_in'))
      { 
         
          $data['fest'] = $this->fest->obtener_id_nombre();
          
          if(sizeof($data['fest']) >= 1){
            foreach ($data['fest'] as $value) {
                $id = $value->idFest;
            }
          }
          
          $rel = array();
          $rel  = $this->tiene->obtener_foros($id); 
          
          if(isset ($rel))
            $data['foros'] = $this->foros->obtener_todos_rel($rel);
        
            $this->load->view('foros_view',$data);
          
        }
      else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }     
    }//fin de index
//-----------------------------------------------------------------------    
    
    function nuevo(){
        //----Validación de datos.
        $this->form_validation->set_rules($this->reglas());
        $this->mensajes();
        
        if ($this->form_validation->run() == FALSE){
            //Mostramos la página de inicio si hay error en los datos.
            //Hay que modificar para manejar la relación 'tiene' de la base de datos
          //Esta relación conecta el festival con los foros. 22-4-2013
            
            $data['foros'] = $this->foros->obtener_todos();
            $data['fest'] = $this->fest->obtener_id_nombre();
            $this->load->view('foros_view',$data);
            
        }else{
            
            $datos= array(
                $this->input->post("nombref",TRUE),
                $this->input->post("ubicacion",TRUE)
            );
        
             $id = $this->foros->insertar($datos);
            
             $datost=array(
             $this->input->post("idFest",TRUE),
                 $id
                );
                $this->tiene->insertar($datost);
        
        redirect('foros/');    
        
        
        }//fin de validación
        
    } //fin de nuevo
//-----------------------------------------------------------------------    
    
    function modificar(){
     if($this->session->userdata('logged_in'))
     {   
        $id = $this->input->get("id",TRUE);
        $data['valores'] = $this->foros->obtener_por_id($id);
        $data['fest'] = $this->fest->obtener_id_nombre();
        $this->load->view('foromod_view',$data);
      }
    else
    {
     //If no session, redirect to login page
     redirect('login', 'refresh');
    }       
    }//fin de modificar
 //-----------------------------------------------------------------------
    function actualizar(){
        $this->form_validation->set_rules($this->reglas());
        $this->mensajes();
        if ($this->form_validation->run() == FALSE){
             $id = $this->input->post("idf",TRUE);
                $data['valores'] = $this->foros->obtener_por_id($id);
                $data['fest'] = $this->fest->obtener_id_nombre();
                $this->load->view('foromod_view',$data);
            
        }else{
            
            $id = $this->input->post("idf",TRUE);
            $eliminar = $this->input->post("eliminar",TRUE);
        
            if($eliminar){
                $this->foros->eliminar($id);
                redirect('foros/'); 
            }else{
                
                $datos = array(
                    $this->input->post("idf",TRUE),
                    $this->input->post("nombref",TRUE),
                    $this->input->post("ubicacion",TRUE)
                );
                
                
                $this->foros->actualizar($datos);
                redirect('foros/');
            } 
        }
        
        
        
    }//fin de actualizar
    
}//fin de la clase

?>