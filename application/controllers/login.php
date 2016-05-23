<?php

/*
 *Controlador del Login 
 * sisFest: Login 30/03/2013
 */

class Login extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        
        $this->load->helper(array('form'));
        $this->load->view('login_view');
    }
    
}


?>