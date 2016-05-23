<?php
/*
 * Controlador Artistas. SisFest Beta
 * Ing. Manuel Güereca
 * 3-9-2013
 */

class Artistas extends CI_Controller{

    //Lista de especificaciones
    var $esp = array(
            'BA'=>'Boletos de Avión',
            'BT'=>'Boletos Terrestre',
            'AU'=>'Autobús',
            'SU'=>'Suburban',
            'VE'=>'Van Express',
            'VC'=>'Van de Carga',
            'HO'=>'Hospedage',
            'VI'=>'Viáticos',
            'CA'=>'Camerinos',
            'CT'=>'Catering',
            'PE'=>'Permisos',
            'RI'=>'Rider',
            'SE'=>'Seguridad',
            'SG'=>'Seguro',
            'MT'=>'Montage'
        );
    
    
    function __construct() {
        parent::__construct();
        $this->load->model('artistas_model','art');
        $this->load->model('requerimientos_model','requi');
        $this->load->helper(array('url','form','MY_form_helper','html'));
        $this->load->library('pagination');
        $this->load->helper('array');
        $this->load->library('form_validation');
    }
        
    function index(){
        //proceso de paginación 3-15-2013
        //sistFest Beta
     if($this->session->userdata('logged_in'))
     { 
        $config = array();
        $config["base_url"] = base_url()."index.php/artistas/index";
        $config['total_rows']= $this->art->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3))?$this->uri->segment(3) : 0;
        
         $data['artistas'] = $this->art->obtener_todos($config["per_page"],$page);
         $data["links"] = $this->pagination->create_links();
       //Fin de proceso de paginación
         if(sizeof($data) > 1){
        $this->load->view('artistas_view',$data);
         }else{
             $this->load->view('artistas_view');
         }
      }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
    }
//----------------------------------------------------------------------------------
    private function reglas(){
        $reglas = array(
            array(
                     'field'   => 'nombrea',
                     'label'   => 'Nombre del Artista',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'nombrerep',
                     'label'   => 'Nombre del Representante',
                     'rules'   => 'RSS|trim'
                  ),
            array(
                     'field'   => 'honorarios',
                     'label'   => 'Honorarios',
                     'rules'   => 'required|RSS|trim|numeric|max_length[10]'
                  ),
            array(
                     'field'   => 'telefono',
                     'label'   => 'Teléfono',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'celular',
                     'label'   => 'Celular',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'email',
                     'label'   => 'E-mail',
                     'rules'   => 'required|trim|RSS|valid_email'
                  ),
            array(
                     'field'   => 'pweb',
                     'label'   => 'Página Web',
                     'rules'   => 'RSS|trim'
                  ),
            array(
                     'field'   => 'categoria',
                     'label'   => 'Categoría',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'esp[]',
                     'label'   => 'Especificación',
                     'rules'   => 'required|RSS|trim'
                  ),
            array(
                     'field'   => 'cantidad[]',
                     'label'   => 'Cantidad',
                     'rules'   => 'RSS|trim'
                  ),
            array(
                     'field'   => 'costo[]',
                     'label'   => 'Costo',
                     'rules'   => 'RSS|trim'
                  )
            
        );
        return $reglas;
    }
    
    function mensajes(){
        $this->form_validation->set_message('required', '%s campo requerido!');
    }
//----------------------------------------------------------------------------------    
    
    function agregar(){
       if($this->session->userdata('logged_in'))
       { 
        $data['especificaciones'] = $this->esp;
        $data['error'] = '';
        $this->load->view('artistasnuevo_view',$data);
         }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
  //----------------------------------------------------------------------------
   function subir_imagen(){
       //sisFest Beta 25/03/2013
         //algoritmo de subir imagenes------------------------------------------
                $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|JPG|GIF|PNG';
		$config['max_size']	= '2000';
		$config['max_width']  = '2024';
		$config['max_height']  = '2008';
                $this->load->library('upload', $config);

		if (!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());	
                        return $error; //regresa el arreglo del error si no lo sube
		}
		else
		{
               
                    $file_info = $this->upload->data();
                    $this->_create_thumbnail($file_info['file_name']);
                    $data = array('upload_data' => $this->upload->data()); //???
                    $imagen = $file_info['file_name'];
                       return $imagen;   
		}
                
                
         //---------------------------------------------------------------------
     }
    //--------------------------------------------------------------------------
     function nuevo(){
         $this->form_validation->set_rules($this->reglas());
         $this->mensajes();
         
            if ($this->form_validation->run() == FALSE){
                
                $data['especificaciones'] = $this->esp;
                $data['error'] = '';
                $this->load->view('artistasnuevo_view',$data);
                
            }else{
                
                $imagen = $this->subir_imagen();
                //datos
                $datos=array(
                $this->input->post("nombrea",TRUE),
                $this->input->post("nombrerep",TRUE),
                $this->input->post("honorarios",TRUE),
                $this->input->post("telefono",TRUE),
                $this->input->post("celular",TRUE),
                $this->input->post("email",TRUE),
                $this->input->post("pweb",TRUE),
                $this->input->post("categoria",TRUE),
                $this->foto = $imagen
                );
                
                
                $id = $this->art->insertar($datos);
                $this->requi->insertar($id);
                redirect('artistas/');
              
            }
        
    }
 //-----------------------------------------------------------------------------
    public function eliminar(){
        
        $ida = $this->input->get("ida",TRUE);
        $this->art->eliminar($ida);
        redirect('artistas/');
    }
  
 //-------------------------------------------------------------------------
    function modificar(){
      if($this->session->userdata('logged_in'))
       {  
        $id = $this->input->get("ida",TRUE);
        $data['valores'] = $this->art->obtener_por_id($id);
        $data['especificaciones'] = $this->esp;
        $data['seleccionadas'] = $this->requi->obtener_seleccion($id);
                
        $this->load->view('artistasmod_view',$data);
        
        }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
        
    }//fin de modificar
    
//-------------------------------------------------------------------------
    function actualizar(){
         //sisFest Beta 25/03/2013
        
         $this->form_validation->set_rules($this->reglas());
         $this->mensajes();
         
         if ($this->form_validation->run() == FALSE){
             $id = $this->input->post("ida",TRUE);
            $data['valores'] = $this->art->obtener_por_id($id);
            $data['especificaciones'] = $this->esp;
            $data['seleccionadas'] = $this->requi->obtener_seleccion($id);
                
            $this->load->view('artistasmod_view',$data);
             
         }else{
             
             $id = $this->input->post("ida",TRUE);
            $imagen = $this->subir_imagen();
            //Actualizamos el nombre de la imagen en la tabla
            //si no nos regresa el arreglo de error.
            if(!is_array($imagen))
                $this->art->actualizar_imagen($id, $imagen);
            $this->art->actualizar($id);
            $this->requi->eliminar($id);
            $this->requi->insertar($id);
            redirect('artistas/');
             
         }//fin de la validación
    }//Fin de la función actualizar
//-----------------------------------------------------------------------------
    function _create_thumbnail($filename){
         //sisFest Beta 25/03/2013
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'uploads/'.$filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']='uploads/thumbs/';
        $config['width'] = 50;
        $config['height'] = 50;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        
    }
    
   
    
}

?>