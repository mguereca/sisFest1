<?php

/*
 * Modelo de artistas
 * SisFest Beta 3-25-2013
 */

class Artistas_model extends CI_Model{
    
    var $nombrea; var $nombrerep; var $honorarios;
    var $telefono; var $celular; var $email; var $pweb;
    var $categoria; var $foto;
    
    function __construct() {
        parent::__construct();
    }
    
    function insertar($datos){
        
        $this->nombrea = $datos[0];
        $this->nombrerep = $datos[1];
        $this->honorarios = $datos[2];
        $this->telefono = $datos[3];
        $this->celular = $datos[4];
        $this->email = $datos[5];
        $this->pweb = $datos[6];
        $this->categoria = $datos[7];
        $this->foto = $datos[8];
        
        $this->db->insert('artistas',  $this);
        
        return $this->db->insert_id();
        
    }
    
     //-----------------------------------------------------------------
    public function obtener_todos($limit, $start){
        $this->db->limit($limit,$start);     
        $this->db->select('ida,foto,nombrea,categoria,telefono,email');
        $query = $this->db->order_by('ida')->get('artistas');
             if($query->num_rows > 0){
                 foreach ($query->result() as $fila){
                     $datos[] = $fila;
                 }   
                 return $datos;
             }else{
                 return NULL;
             }
          return false;   
         }//Fin de obtener_todos
//-------------------------------------------------------------------
         public function record_count(){
             return $this->db->count_all('artistas');
             
         }
//----------------------------------------------------------------
     function eliminar($id){
         $this->db->where('ida',  $id);
         $this->db->delete('artistas');
         
     }//fin de eliminar         

//-------------------------------------------------------------------
         function obtener_por_id($id){
        $query = $this->db->get_where('artistas',array('ida'=>$id));
        if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
         return false;
     }//fin de obtener por id
//--------------------------------------------------------------------
     
     function actualizar($id){
         
         $this->ida = $id;
         $this->nombrea = $this->input->post("nombrea",TRUE);
        $this->nombrerep = $this->input->post("nombrerep",TRUE);
        $this->honorarios = $this->input->post("honorarios",TRUE);
        $this->telefono = $this->input->post("telefono",TRUE);
        $this->celular = $this->input->post("celular",TRUE);
        $this->email = $this->input->post("email",TRUE);
        $this->pweb = $this->input->post("pweb",TRUE);
        $this->categoria = $this->input->post("categoria",TRUE);
        
        $this->db->where('ida',  $this->ida);
        $this->db->update('artistas',$this);
         
     }
     
//-------------------------------------------------------------------
     function actualizar_imagen($id, $imagen){
          //sisFest Beta 25/03/2013
         $this->ida = $id;
         $this->foto = $imagen;
         
         $this->db->where('ida',$this->ida);
         $this->db->update('artistas',$this);
     }
//Obtener lista de artistas
//---------------------------------------------------------------------
     function obtener_lista(){
         
         $this->db->select('ida, nombrea');
         $query = $this->db->get('artistas');
         return $query->result();
         
     }
//---------------------------------------------------------------------
      public function obtener_todos_art(){
           
        $this->db->select('ida,nombrea,FORMAT(honorarios,2) as honorarios,nombrerep,telefono,celular,email,pweb,foto,categoria',FALSE);
        $query = $this->db->order_by('ida')->get('artistas');
             if($query->num_rows > 0){
                 foreach ($query->result() as $fila){
                     $datos[] = $fila;
                 }   
                 return $datos;
             }else{
                 return NULL;
             }
          return false;   
         }//Fin de obtener_todos
//---------------------------------------------------------------------------         
    public function obtener_art_prog(){
           
        $this->db->select('ida,nombrea,foto,categoria');
        $query = $this->db->order_by('ida')->get('artistas');
             if($query->num_rows > 0){
                 foreach ($query->result() as $fila){
                     $datos[] = $fila;
                 }   
                 return $datos;
             }else{
                 return NULL;
             }
          return false;   
         }//Fin de obtener_todos
}

?>