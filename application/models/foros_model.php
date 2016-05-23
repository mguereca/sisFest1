<?php

/*
 * Modelo de los foros del festival o localidades en donde hay 
 * eventos culturales.
 */

class Foros_model extends CI_Model{
    
    var $idf; var $nombref; var $ubicacion;
    
    function __construct() {
        parent::__construct();
    }
//-----------------------------------------------------------    
    function Insertar($datos){
        
        $this->nombref = $datos[0];
        $this->ubicacion = $datos[1];
        
        $this->db->insert('foros', $this);
        return $this->db->insert_id();
    }
//--------------------------------------------------------------    
    function obtener_todos(){
             
             $query = $this->db->order_by('idf')->get('foros');
             if($query->num_rows > 0){
                 foreach ($query->result() as $fila){
                     $datos[] = $fila;
                 }   
                 return $datos;
             }else{
                 return NULL;
             }
         }//Fin de obtener_todos
//-------------------------------------------------------------

          function obtener_todos_rel($rel){
              
              foreach ($rel as $value) {
                  
                   $query = $this->db->get_where('foros',array('idf'=>$value->foros_idf));
                   
                   if($query->num_rows > 0){
                        foreach ($query->result() as $fila){
                            $datos[] = $fila;
                        }   
                    }  
              }
              
              return $datos;
             
             
         }//Fin de obtener_todos_rel
//--------------------------------------------------------------
     function obtener_por_id($id){
        $query = $this->db->get_where('foros',array('idf'=>$id));
        if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
     }//fin de obtener por id

//----------------------------------------------------------------
     function actualizar($datos){
                       
         $this->idf = $datos[0];
         $this->nombref = $datos[1];
         $this->ubicacion = $datos[2];
         
         $data=array(
             'nombref'=>  $this->nombref,
             'ubicacion'=> $this->ubicacion
         );
         
         $this->db->where('idf',  $this->idf);
         $this->db->update('foros',$data);
         
         
     }//fin de actualizar
//----------------------------------------------------------------
     function eliminar($id){
         $this->db->where('idf',  $id);
         $this->db->delete('foros');
         
     }//fin de eliminar
//----------------------------------------------------------------
     //Mod 31/03/2013
     function obtener_nombre_por_id($id){
         $this->db->select('nombref');
         $query = $this->db->get_where('foros',array('idf'=>$id));
        if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    return $fila;
                }
                
         }
         
     }
    
}//fin de la clase
?>