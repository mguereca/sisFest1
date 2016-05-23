<?php

class Festivales_model extends CI_Model{
    
    var $idFest; 
    var $nomFest; 
    var $fechIni; 
    var $fechFin; 
    var $generos; 
    var $activo; 
    
 function __construct() {
     parent::__construct();
    
 }
 
 //----------------------------------------------------------------------------
 function Insertar($datos){
     
     
      $this->nomFest = $datos[0];
        $this->fechIni = $datos[1];
        $this->fechFin = $datos[2];
        $this->generos = $datos[3];
        $this->activo = $datos[4];
     
     $this->db->insert('festivales',  $this);
     
 }//fin de insertar
//----------------------------------------------------------------------------- 
 function actualizar($datosa,$id){
     $this->nomFest = $datosa[0];
        $this->fechIni = $datosa[1];
        $this->fechFin = $datosa[2];
        $this->generos = $datosa[3];
        $this->activo = $datosa[4];
        $this->idFest = $id;
     
     $datos=array(
         'nomFest'=>$this->nomFest,
         'fechIni'=>$this->fechIni,
         'fechFin'=>$this->fechFin,
         'generos'=>$this->generos,
         'activo'=>$this->activo
             );
    
     $this->db->where('idFest',  $this->idFest);
     $this->db->update('festivales',$datos);
 }//Fin de actualizar
//----------------------------------------------------------------------------- 
 function obtener_por_activo(){
     
     $query = $this->db->get_where('festivales',array('activo'=>1));
     if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
 }//fin de obtener_por_activo
//----------------------------------------------------------------------------- 
 function obtener_todos(){
             
             $query = $this->db->order_by('idFest')->get('festivales');
             if($query->num_rows > 0){
                 foreach ($query->result() as $fila){
                     $datos[] = $fila;
                 }   
                 return $datos;
             }else{
                 return NULL;
             }
         }//Fin de obtener_todos
//-----------------------------------------------------------------------------         
function obtener_por_id($id){
        $query = $this->db->get_where('festivales',array('idFest'=>$id));
        if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
} 
//-----------------------------------------------------------------------------
function obtener_id_nombre(){
    
    $this->db->select('idFest,nomFest');
    $query = $this->db->get_where('festivales',array('activo'=>1));
    if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
}

//-----------------------------------------------------------------------
function obtener_fechas_activo(){
    $this->db->select('fechIni,fechFin');
    $query = $this->db->get_where('festivales',array('activo'=>1));
     if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
    
}
    
}//fin de Festivales_model

?>