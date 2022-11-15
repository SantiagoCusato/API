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
        $start= '';
        $filt = '';
        if (!array_key_exists('sort', $_GET) && !array_key_exists('order',$_GET) && !array_key_exists('limit', $_GET) && !array_key_exists('start',$_GET) ){
            $instrumento = $this->model->getAll();
            $this->view->response($instrumento);
            }
            else{
           if (array_key_exists('start', $_GET )){
            $start = $_GET['start'];
           if (array_key_exists('limit' , $_GET)){
            $limit = $_GET['limit'];
            $query = [
                $start => "OFFSET $start"
            ];
             $start_query = $query[$start];
            $pagination = $this->model->PageOrder($limit , $start_query);
            $this->view->response($pagination);
            die();
           }
        }
           else{
              $this->view->response("Error al completar los campos", 400);
          }
        
           if(array_key_exists('sort', $_GET)){
            $filt = $_GET['sort'];
           if (array_key_exists('order', $_GET))
            $filt =  $filt. ' ' .$_GET['order']; 
            $filt = " ORDER BY " . $filt;
            $instrumentoFilt = $this->model->OrderBy($filt);
            $this->view->response($instrumentoFilt);
            die();
           }
            else {
            $this->view->response("Error al completar los campos", 400); 
           }  
         
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

        if (empty($Instrumento->instrumento) || empty($Instrumento->descripcion) || empty($Instrumento->precio)|| empty($Instrumento->id_fk)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($Instrumento->instrumento, $Instrumento->precio, $Instrumento->descripcion,$Instrumento->id_fk);
            $Instrumento = $this->model->get($id);
            $this->view->response($Instrumento, 201);
        }
    }
    public function ModInstrumento($params = null){
        $id = $params[':ID'];
        $instrumentoMod = $this->model->get($id);
        if($instrumentoMod){
            $body = $this->getData();
            $instrumento = $body->instrumento;
            $precio = $body->precio;
            $descripcion = $body->descripcion;
            $id_fk = $body->id_fk;
            $instrumentoMod = $this->model->updateInstrumento($id,$instrumento,$precio,$descripcion,$id_fk);
            $this->view->response ("Instrumento id = $id Modificado con exito", 201);
        } else 
             $this->view->response("Instrumento con el id=$id no existe", 404);
        
    }

}