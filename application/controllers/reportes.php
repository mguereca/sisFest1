<?php

/*
 * Controlador de Reportes
 * sisFest Beta 02/04/2013
 * Ing. Manuel Güereca @rezzaca
 */

class Reportes extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('artistas_model','art');
        $this->load->model('foros_model','foros');
        $this->load->model('festivales_model','fest');
        $this->load->model('requerimientos_model','requi');
        $this->load->model('programacion_model','prog');
        $this->load->helper(array('url','form','MY_form_helper','html'));
    }
//------------------------------------------------    
    function artistas(){
        
    if($this->session->userdata('logged_in'))
     {     
        $data['artistas'] = $this->art->obtener_todos_art();
        $this->load->view('rep_artistas_view',$data);
     }else{
         //If no session, redirect to login page
        redirect('login', 'refresh');
     }
    }
//------------------------------------------------    
    function programa(){
        
        if(isset ($_GET['idf'])){
            $idf = $_GET['idf'];
            $data['programa'] = $this->prog->obtener_programa_f($idf);
        }else{
        $data['programa'] = $this->prog->obtener_programa();    
        }
        
        
         $data['artistas'] = $this->art->obtener_art_prog();
         $data['foros'] = $this->foros->obtener_todos();
        $this->load->view('rep_prog_view',$data);
    }
//------------------------------------------------
    function art_requi(){
     if($this->session->userdata('logged_in'))
     {     
        $data['lista'] = $this->art->obtener_lista();
        $data['requi'] = $this->requi->obtener_todo();
        $this->load->view('rep_requi_view',$data);
     }else{
          //If no session, redirect to login page
        redirect('login', 'refresh');
         
     }
    }
//------------------------------------------------
    

}
?>