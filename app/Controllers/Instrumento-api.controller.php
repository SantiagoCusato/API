<?php
require_once './app/Models/Instrumento.model.php';
require_once './app/views/Instrumento.view.php';

class InstrumentoApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new InstrumentoModel();
        $this->view = new InstrumentoView();
        
        
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getInstrumentos() { 
        $limit = '';
        $offset= '';
        $filt = '';
           if (key_exists('start', $_GET )){
            $offset = $_GET['start'];
           if (key_exists('limit' , $_GET)){
            $limit = $_GET['limit'];
            $pagination = $this->model->PageOrder($limit , $offset);
            $this->view->response($pagination);
           }
           else{
              $this->view->response("Error al completar los input", 404);
           }
        }
           if(array_key_exists('sort', $_GET)){
            $filt = $_GET['sort'];
           if (array_key_exists('order', $_GET))
            $filt =  $filt. ' ' .$_GET['order']; 
            $filt = " ORDER BY " . $filt;
            $instrumentoFilt = $this->model->OrderBy($filt);
            $this->view->response($instrumentoFilt);
            
           }
        //   else{
          //  $this->view->response("Error del servidor", 504); 
         //  }
            
        
           
           if (array_key_exists('familia', $_GET)) {
              $familia = $_GET['familia']; 
              $instrumentosByFam = $this->model->getInstrumentosByFamily($familia);
              $this->view->response($instrumentosByFam);
             }
            else {
            $instrumento = $this->model->getAll();
            $this->view->response($instrumento);
            }
        }
           

    public function getInstrumento($params = null) {
        $id = $params[':ID'];
        $instrumento = $this->model->get($id);
        if ($instrumento)
           $this->view->response($instrumento);
        else 
            $this->view->response("Instrumento con el id=$id no existe", 404);
    }

    public function deleteInstrumento($params = null) {
        $id = $params[':ID'];
        $Instrumento = $this->model->get($id);
        if ($Instrumento) {
            $this->model->delete($id);
            $this->view->response($Instrumento);
        } else 
            $this->view->response("Instrumento con el id=$id no existe", 404);
    }

    public function insertInstrumento($params = null) {
        $Instrumento = $this->getData();

        if (empty($Instrumento->instrumento) || empty($Instrumento->descripcion) || empty($Instrumento->precio)|| empty($Instrumento->familia)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($Instrumento->instrumento, $Instrumento->descripcion, $Instrumento->precio,$Instrumento->familia);
            $Instrumento = $this->model->get($id);
            $this->view->response($Instrumento, 201);
        }
    }
    public function ModificarInstrumento($params = null){
        $id = $params[':ID'];
        $instrumentoMod = $this->model->get($id);
        if($instrumentoMod){
            $body = $this->getData();
            $instrumento = $body->instrumento;
            $precio = $body->precio;
            $descripcion = $body->descripcion;
            $familia = $body->familia;
            $instrumentoMod = $this->model->updateInstrumento($id,$instrumento,$precio,$descripcion,$familia);
            $this->view->response ("Instrumento id = $id Modificado con exito", 200);
        } else 
             $this->view->response("Instrumento con el id=$id no existe", 404);
        
    }

}