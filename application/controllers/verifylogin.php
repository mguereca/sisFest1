<?php

/*
 * Controlador verificador de login y password.
 * sisFest Beta.
 * Creado por Ing. Manuel Güereca
 * mod 16-4-2013
 */
class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('usuarios_model','user',TRUE);
   $this->load->model('usua_foro_model','ufm');
   $this->load->model('foros_model','foros');
   $this->load->model('Festivales_model','fest');
   $this->load->library('encrypt');
 }
   function mensajes(){
        $this->form_validation->set_message('required', '%s campo requerido!');
    }

 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Login', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
   $this->mensajes();
   
   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.&nbsp; User redirected to login page
     $this->load->view('login_view');
   }
   else
   {
     //Go to private area
     redirect('home', 'refresh');
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.&nbsp; Validate against database
   $login = $this->input->post('username');
   
   //query the database
   $result = $this->user->login($login, $password);
    
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->idu,
         'login' => $row->login,
           'nombreu'=>$row->nombreu,
           'tipo'=>$row->tipo
       );
       
        $idf = $this->ufm->obtener_por_idu($sess_array['id']);
        
            if(isset ($idf)){
                foreach ($idf as $value) {
                    $sess_array['idf'] = $value;
                }
                
                $nforo = $this->foros->obtener_nombre_por_id($sess_array['idf']);
                    if(isset ($nforo)){
                        foreach ($nforo as $value) {
                            $sess_array['nombref'] = $value;
                        }
                    }
            }       
       $fechFest = $this->fest->obtener_fechas_activo();
       if(isset ($fechFest)){
           foreach ($fechFest as $value) {
               $sess_array['fechIni'] = $value->fechIni;
               $sess_array['fechFin'] = $value->fechFin;
           }
       }
       
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'El login o el password son incorrectos.');
     $this->form_validation->set_message('required','%s es campo requerido!');
     return false;
   }
 }
}
?>