<?php

/*
 * Controlador Home. SisFest Beta.
 * Ing. Manuel Güereca
 * 24-4-2013
 * mod 27-8-2013
 */

session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
      
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['login'] = $session_data['login'];
     $data['nombreu'] = $session_data['nombreu'];
     
     //si son programadores o encargados de foros, pasamos la informacion
     
     if(isset ($session_data['nombref'])&& isset ($session_data['idf'])){
         $data['idf'] = $session_data['idf'];
         $data['nombref'] = $session_data['nombref'];
     }
     
     $tipo = $session_data['tipo'];
    
     switch ($tipo) {
         case 1:
             $this->load->view('inicio_admon_view', $data);
             break;
         case 2:
             $this->load->view('inicio_prog_view', $data);
             break;
         case 3:
             $this->load->view('inicio_eforo_view', $data);
             break;
     }
    
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }

}
?>