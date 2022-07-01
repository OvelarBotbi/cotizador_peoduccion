<?php
class categorias{
    
    private $id;
	private $padre;
	private $id_cat;
    private $nombre;
	private $precio;
    
    
    public function __Construct($id,$padre,$id_cat,$nombre,$precio){
        $this -> id = $id;
		$this -> padre = $padre;
        $this -> id_cat = $id_cat;
        $this -> nombre = $nombre;
        $this -> precio = $precio;
        
    }
    
    public function id(){
        return $this -> id;
    }    
	public function padre(){
        return $this -> padre;
    }
    public function id_cat(){
        return $this -> id_cat;
    }
    public function nombre(){
            return $this -> nombre;
        }
    public function precio(){
            return $this -> precio;
        }
    
    
}
?>