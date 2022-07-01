<?php
class Usuario{
    private $usuario;
    private $contraseña;
    
    function __construct($usuario,$contraseña){
        $this -> usuario = $usuario;
        $this -> contraseña = $contraseña;
    }
    
    public function usuario(){
        return $this -> usuario;
    }
}
?>