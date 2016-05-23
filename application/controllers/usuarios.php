<?php

/*
 * Controlador de usuarios
 * mod 16-4-2013
 * sisFest Beta
 * Creado por Ing. Manuel Güereca
 * 
 */

class Usuarios extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model');
        $this->load->model('foros_model','foros');
        $this->load->model('usua_foro_model','ufm');
        $this->load->helper(array('url','form','MY_form_helper','html'));
        $this->load->library('form_validation');
        $this->load->library('encrypt');
    }
//------------------------------------------------------------------------
    function index(){
        if($this->session->userdata('logged_in'))
        {
        $data['usuarios'] = $this->usuarios_model->obtener_todos();
        $data['foros'] = $this->foros->obtener_todos();
        $this->load->view('usuarios_view',$data);
        }
        else{
            
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
//------------------------------------------------------------------------
    private function reglas(){
        $reglas = array(
            array(
                     'field'   => 'nombreu',
                     'label'   => 'Nombre del Usuario',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'email',
                     'label'   => 'E-mail',
                     'rules'   => 'required|trim|RSS|valid_email'
                  ),
            array(
                     'field'   => 'login',
                     'label'   => 'Login',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|RSS|trim|matches[passwordv]'
                  ),
            array(
                     'field'   => 'passwordv',
                     'label'   => 'El password de verificación no concuerda con el anterior',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'tipo',
                     'label'   => 'Tipo de Usuario',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'idf',
                     'label'   => 'Foro',
                     'rules'   => 'required|RSS|trim'
                  ),
        );
        return $reglas;
    }
//----------------------------------------------------------------------------    
    function mensajes(){
        $this->form_validation->set_message('required', '%s campo requerido!');
    }
//------------------------------------------------------------------------
     function nuevo(){
         $this->form_validation->set_rules($this->reglas());
         $this->mensajes();
         if ($this->form_validation->run() == FALSE){
              $data['usuarios'] = $this->usuarios_model->obtener_todos();
                $data['foros'] = $this->foros->obtener_todos();
                $this->load->view('usuarios_view',$data);
         }else{
             //-Datos-----
             $tipo = $this->input->post("tipo",TRUE);
             $datos = array(
                 $this->input->post("nombreu",TRUE),
                 $this->input->post("email",TRUE),
                 $this->input->post("login",TRUE),
                 md5($this->input->post("password",TRUE)),
                 $tipo
             );
             $idu = $this->usuarios_model->insertar($datos);
                if(($tipo == 3)||($tipo == 2)){
                    $this->ufm->insertar($idu,  $this->input->post("idf",TRUE));
                }
                
             redirect('usuarios/');
         }
        
        
    }
//-------------------------------------------------------------------------
    function modificar(){
        if($this->session->userdata('logged_in'))
        {
        $id = $_GET["idu"];
        $data['valores'] = $this->usuarios_model->obtener_por_id($id);
        $data['foros'] = $this->foros->obtener_todos();
        $idf = $this->ufm->obtener_por_idu($id);
        
        if(isset ($idf))
            $data['idf'] = $idf; 
        
        $this->load->view('usuariosmod_view',$data);
        }
        else
           {
             //If no session, redirect to login page
             redirect('login', 'refresh');
           }
        
    }//fin de modificar
    
//-------------------------------------------------------------------------
    function actualizar(){
         $this->form_validation->set_rules($this->reglas());
         $this->mensajes();
         if ($this->form_validation->run() == FALSE){
             $id = $this->input->post("idu",TRUE);
            $data['valores'] = $this->usuarios_model->obtener_por_id($id);
            $data['foros'] = $this->foros->obtener_todos();
            $idf = $this->ufm->obtener_por_idu($id);
        
        if(isset ($idf))
            $data['idf'] = $idf; 
        
        $this->load->view('usuariosmod_view',$data);
             
         }else{
             //-Datos-----
             $tipo = $this->input->post("tipo",TRUE);
             $datos = array(
                 $this->input->post("nombreu",TRUE),
                 $this->input->post("email",TRUE),
                 $this->input->post("login",TRUE),
                 $this->encrypt->encode($this->input->post("password",TRUE)),
                 $tipo
             );
             
                $id = $this->input->post("idu",TRUE);
                $eliminar = $this->input->post("eliminar",TRUE);
        
        if($eliminar){
            $this->usuarios_model->eliminar($id);
            redirect('usuarios/');
            
        }else{
            $this->usuarios_model->actualizar($datos);
            if($tipo == 3||($tipo == 2)){
                $this->ufm->eliminar($id);
                    $this->ufm->insertar($id,  $this->input->post("idf",TRUE));
                }
            redirect('usuarios/');
        }
             
         } //fin de la validación
    }//fin de actualizar
    
}//fin del controlador
?>