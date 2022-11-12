<?php

class InstrumentoModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db;charset=utf8', 'root', '');
    }
    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM instrumento");
        $query->execute();
        $instrumentos = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $instrumentos;
    }
    public function OrderBy($filt){
        $query = $this->db->prepare("SELECT instrumento.id , instrumento.instrumento , instrumento.precio , instrumento.descripcion , instrumento.id_fk
         FROM instrumento $filt");
        $query->execute();
        $instrumentoFilt = $query->fetchAll(PDO::FETCH_OBJ);
        return $instrumentoFilt;
    }
    public function PageOrder($limit, $offset){
        $query = $this->db->prepare("SELECT * FROM instrumento LIMIT ? OFFSET ?");
        $query->execute([$limit,$offset]);
        $pagination = $query->fetchAll(PDO::FETCH_OBJ);
        return $pagination;
    }

     public function getInstrumentosByFamily($familia){
         $query = $this->db->prepare ("SELECT instrumento.id, instrumento.instrumento, instrumento.precio, instrumento.descripcion, instrumento.familia  FROM instrumento JOIN familia
         ON instrumento.id_fk = familia.id WHERE instrumento.id_fk= ");
         $query->execute([$familia]);
         $instrumentoByFam = $query->fetchAll(PDO::FETCH_OBJ);
         return $instrumentoByFam;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM instrumento WHERE id = ?");
        $query->execute([$id]);
        $instrumento = $query->fetch(PDO::FETCH_OBJ);
        
        return $instrumento;
    }

    public function insert($instrumento, $precio, $descripcion,$familia) {
        $query = $this->db->prepare("INSERT INTO instrumento (instrumento, precio, descripcion,familia) VALUES (?, ?, ?,?)");
        $query->execute([$instrumento, $precio, $descripcion,$familia]);

        return $this->db->lastInsertId();
    }
    public function updateInstrumento ($id , $instrumento, $precio, $descripcion, $familia ){
        $query = $this->db->prepare('UPDATE instrumento SET  instrumento = ?,precio= ? ,descripcion = ?, id_fk = ? WHERE id= ?');
        $query->execute([$instrumento ,$precio,$descripcion,$familia,$id]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM instrumento WHERE id = ?');
        $query->execute([$id]);
    }

}

