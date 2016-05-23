<?php

/*
 * Modelo de la relación usuario-foro
 * sisFet Beta 31/03/2013
 */

class Usua_foro_model extends CI_Model{
    var $usuarios_idu; var $foros_idf;
    
    function __construct() {
        parent::__construct();
    }
    
    function insertar($idu,$idf){
        $this->usuarios_idu = $idu;
        $this->foros_idf = $idf;
        
        $this->db->insert('usua_foro', $this);
        
    }
    
    function obtener_por_idu($idu){
        
        $this->usuarios_idu = $idu;
        
        $this->db->select('foros_idf');
        
        $query = $this->db->get_where('usua_foro',array('usuarios_idu'=>  $this->usuarios_idu));
       if($query->num_rows > 0){ 
        foreach ($query->result() as $value) {
            $idf = $value;     
        }
        return $idf;
       }else{
           return NULL;
       }
    }
    
    function eliminar($idu){
        
         $this->db->where('usuarios_idu',  $idu);
         $this->db->delete('usua_foro');
    }
}

?>