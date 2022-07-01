<?php
class relacion{
    private $id;
	private $id_cat;
	private $nombre;
	private $descripcion;
	private $padre;
	
    public function __Construct($id,$id_cat,$nombre,$descripcion,$padre){
        $this -> id = $id;
		$this -> id_cat = $id_cat;
        $this -> nombre = $nombre;
        $this -> descipcion = $descripcion;
        $this -> padre = $padre;
    }
    
    public function id(){
        return $this -> id;
    }    
	public function id_cat(){
        return $this -> id_cat;
    }
    public function nombre(){
        return $this -> nombre;
    }
    public function descipcion(){
        return $this -> descipcion;
    }
    public function padre(){
        return $this -> padre;
    }
}
?>