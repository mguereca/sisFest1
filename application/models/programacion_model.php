<?php

/*
 * Modelo de la relación de la BD referente a la tabla de programacion
 * sisFest 31/03/2013
 * Creado por Ing. Manuel Güereca 
 */

class Programacion_model extends CI_Model{

    var $idp; var $diahora; var $artistas_ida; var $foros_idf;
    
    function __construct() {
        parent::__construct();
    }
//-----------------------------------------------------------------------------  
    
    function insertar(){
        
        $this->artistas_ida = $this->input->post('artista');
        $dia = $this->input->post('fecha');
        $hora = $this->input->post('hora');
        $this->foros_idf = $this->input->post('idf');
        $this->diahora = $dia." ".$hora;
        $this->db->insert('programacion',$this);
    }
//------------------------------------------------------------------------------    
    
    function elimina($idp){
        
        $this->db->where('idp',$idp);
        $this->db->delete('programacion');
        
    }
//------------------------------------------------------------------------------    
    function obtener_lista($idf){
        
        $this->db->select('idp,DATE(diahora) AS `dia`, TIME(diahora) AS `hora`,artistas_ida');
        $query = $this->db->get_where('programacion',array('foros_idf'=>$idf));
        return $query->result();
        
    }
//------------------------------------------------------------------------------
    function obtener_programa(){
         $this->db->select('idp,DATE(diahora) AS `dia`, TIME(diahora) AS `hora`,artistas_ida,foros_idf');
        $query = $this->db->get('programacion');
        return $query->result();
    }
//------------------------------------------------------------------------------
    function obtener_programa_f($idf){
         $this->db->select('idp,DATE(diahora) AS `dia`, TIME(diahora) AS `hora`,artistas_ida,foros_idf');
        $query = $this->db->get_where('programacion',array('foros_idf'=>$idf));
        return $query->result();
    }
    
}


?>