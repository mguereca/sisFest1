<?php

/*
 * Modelo de la relación Tiene que relaciona 
 * el Festival con los foros.
 * sisFest Beta 28/03/2013
 * mod 2-5-2013
 */

class Tiene_model extends CI_Model{
    
    var $festivales_idFest; var $foros_idf;
    
    function __construct() {
        parent::__construct();
    }
    
    function insertar($datos){
        
        $this->festivales_idFest = $datos[0];
        $this->foros_idf = $datos[1];
        
        $this->db->insert('tiene',$this);
    }
    
    function obtener_foros($id){
        $this->db->select('foros_idf');
        $query = $this->db->get_where('tiene',array('festivales_idFest'=>$id));
        if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }else{
             //return FALSE;
             return NULL;
         }
    }
}
?>