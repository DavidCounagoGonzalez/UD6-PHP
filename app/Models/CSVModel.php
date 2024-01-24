<?php

declare(strict_types = 1);

namespace Com\Daw2\Models;

class CSVModel{
    
    private $ficheroPontevedra;
    
//    private $instancia = null;
    
    public function __construct(){
        $this->ficheroPontevedra = $_ENV['folder.data'].'poblacion_pontevedra_2020_totales.csv';
    }
    
//    public static function getInstance() : CSVModel{
//        if(is_null($this->instancia)){
//            $this->instancia = new CSVModel();
//        }
//        return $this->instancia;
//    }
    
    /**
     * 
     * @return type Devuelve un array con los datos o false si no se logra cargar el fichero
     */
    function getPoblacionHistorica(){
        $filepath = $_ENV['folder.data'].'poblacion_pontevedra.csv';
        return $this->loadCSVData($filepath);
    }
    
    /**
     * 
     * @return type Devuelve un array con los datos o false si no se logra cargar el fichero
     */
    function getPoblacionGruposEdad(){
        $filepath = $_ENV['folder.data'].'poblacion_grupos_edad.csv';
        return $this->loadCSVData($filepath);
    }
    
    /**
     * 
     * @return type Devuelve un array con los datos o false si no se logra cargar el fichero
     */
    function getTotales2020(){        
        return $this->loadCSVData($this->ficheroPontevedra);
    }
    
    private function loadCSVData(string $filepath){
        $csvfile = @file($filepath);
        if($csvfile !== false){
            $resultado = [];
            foreach($csvfile as $linea){
                $resultado[] = str_getcsv($linea, ';');
            }
            return $resultado;
        }
        else{
            return false;
        }
    }
    
    public function insertPoblacion2020(string $municipio, int $poblacion) : bool{
        $registro = array($municipio, 'Total', 2020, $poblacion);
        $resource = @fopen($this->ficheroPontevedra, 'a');
        if($resource !== false){
            $res = fputcsv($resource, $registro, ';');
            fclose($resource);        
            return $res !== false;
        }
        else{
            return false;
        }
    }
}