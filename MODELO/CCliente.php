<?php
    class CCliente{
        private $docIdentidadC;
        private $aPaterno;
        private $aMaterno;
        private $NombreC;
        private $sexo;
        private $Pais;
        private $fNacimiento; 


        function __construct($newdocIdentidadC,$newaPaterno, $newaMaterno, $newNombreC, $newsexo, $newPais, $newfNacimiento){
            $this-> docIdentidadC=$newdocIdentidadC;
            $this-> aPaterno=$newaPaterno;
            $this-> aMaterno=$newaMaterno;
            $this-> NombreC=$newNombreC;
            $this-> sexo=$newsexo;
            $this-> Pais=$newPais;
            $this-> fNacimiento=$newfNacimiento; 
        }

        


        function __get($name){
            return $this->$name;
        }

        function __set($name, $value) {
            $this->$name = $value;
        }


    }

    


?>