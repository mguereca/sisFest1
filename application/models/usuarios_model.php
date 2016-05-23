<?php

/*
 * Modelo de los usuarios
 * SisFest beta
 */

class Usuarios_model extends CI_Model{
    
    var $nombreu; var $email; var $login; var $password; var $tipo; var $idu;
    
    function __construct() {
        parent::__construct();
        
    }
    
//------------------------------------------------------------
    function Insertar($datos){
        
        $this->nombreu = $datos[0];
        $this->email = $datos[1];
        $this->login = $datos[2];
        $this->password = $datos[3];
        $this->tipo = $datos[4];
        
        $this->db->insert('usuarios',  $this);
        return $this->db->insert_id();
        
    }
    
//-----------------------------------------------------------------
    function obtener_todos(){
             
             
        $query = $this->db->order_by('idu')->get('usuarios');
             if($query->num_rows > 0){
                 foreach ($query->result() as $fila){
                     $datos[] = $fila;
                 }   
                 return $datos;
             }else{
                 return NULL;
             }
         }//Fin de obtener_todos
//-------------------------------------------------------------------
         function obtener_por_id($id){
        $query = $this->db->get_where('usuarios',array('idu'=>$id));
        if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
     }//fin de obtener por id
//--------------------------------------------------------------------
      function actualizar(){
         $this->idu = $this->input->post("idu",TRUE);
         $this->nombreu = $this->input->post("nombreu",TRUE);
         $this->email = $this->input->post("email",TRUE);
         $this->login = $this->input->post("login",TRUE);
         $this->password = md5($this->input->post("password",TRUE));
         $this->tipo = $this->input->post("tipo",TRUE);
         $datos=array(
             'nombreu'=>  $this->nombreu,
             'email'=> $this->email,
             'login'=>  $this->login,
             'password'=>  $this->password,
             'tipo' => $this->tipo
         );
         
         $this->db->where('idu',  $this->idu);
         $this->db->update('usuarios',$datos);
         
         
     }//fin de actualizar
//----------------------------------------------------------------
     function eliminar($id){
         $this->db->where('idu',  $id);
         $this->db->delete('usuarios');
         
     }//fin de eliminar
     
//-----------------------------------------------------------------
    function login($login,$password){
        //$password = $this->encrypt->encode($password);
        
        
        $this->db->select('idu, nombreu, login,tipo');
        $this->db->from('usuarios');
        $this->db->where('login',$login);
        $this->db->where('password',md5($password)); //previamente encriptado
        $this->db->limit(1);
        
        $query = $this->db->get();
       
        
        if($query->num_rows()==1){
            return $query->result();
        }else{
            return FALSE;
        }
        
    } //fin de la función login
//-----------------------------------------------------------------------   
    
    //------------------------------------------------------------
    function usuario_admon(){
        
        $this->nombreu = 'Administrador del sistema.';
        $this->email = 'admon@sisFest.com';
        $this->login = 'admon';
        $this->password = md5('admon');
        $this->tipo = 1;
        
        $this->db->insert('usuarios',  $this);
        return TRUE;
        
    }
}//fin de la clase Usuarios_model

?>