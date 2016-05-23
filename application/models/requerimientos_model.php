<?php

/*
 * Modelo de Requerimientos
 * SisFest Beta 3-14-2013
 */

class Requerimientos_model extends CI_Model{
    
    var $especificacion;    var $cantidad;
    var $costou; var $artistas_ida;
    var $idr;


    function __construct() {
        parent::__construct();
        $this->load->helper('array');
    }
//--------------------------------------------------------------------    
    function Insertar($id){
        $this->artistas_ida = $id;
        $esp = $this->input->post('esp',TRUE);//Arreglo de especificaciones
        $cantT = $this->input->post('cantidad',TRUE);
        $costT = $this->input->post('costo',TRUE);
        $cant = $this->sinceros($cantT);
        $cost = $this->sinceros($costT);
       
       
        
        $num = count($esp);
        
        for($i = 0; $i < $num; $i++){
            $this->especificacion = $esp[$i];
            $this->cantidad = $cant[$i];
            $this->costou = $cost[$i];
            $this->db->insert('requerimientos', $this);
        }
        
    }
//-----------------------------------------------------------    
    private function sinceros($arr){
        $arrS = array();
         foreach($arr as $v){
            if($v != 0)
            $arrS[] = $v;
        }
        return $arrS;
        
    }
//------------------------------------------------------------    
     function obtener_seleccion($id){
         
         $query = $this->db->get_where('requerimientos',array('artistas_ida'=>$id));
         if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
         return false;
     }
//----------------------------------------------------------------     
     function eliminar($id){
          $this->db->where('artistas_ida',  $id);
         $this->db->delete('requerimientos');
     }
//----------------------------------------------------------------
     function obtener_todo(){
         $this->db->select('idr,especificacion,cantidad,FORMAT(costou,2) as costou, artistas_ida',FALSE);
         $query = $this->db->get('requerimientos');
         if($query->num_rows > 0){
                foreach ($query->result() as $fila){
                    $data[] = $fila;
                }
                return $data;
         }
         return false;
     }
    
}//fin del modelo
//----------------------------------------------------------------

?>