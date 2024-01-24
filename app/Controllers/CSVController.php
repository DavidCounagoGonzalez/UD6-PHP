<?php
declare(strict_types = 1);

namespace Com\Daw2\Controllers;

class CSVController extends \Com\Daw2\Core\BaseController {
    
    public function poblacionPontevedra() : void{
        $data = [];
        $data['titulo'] = 'Histórico población Pontevedra';
        $data['seccion'] = '/csv/historico';
        $modelo = new \Com\Daw2\Models\CSVModel(); 
        //$modelo = \Com\Daw2\Models\CSVModel::getInstance();
        $data['datos'] = $modelo->getPoblacionHistorica();
        if($data['datos'] !== false){
        
            $resultado = $this->getMaxMin($data['datos']);
//        var_dump($masPoblacion);
//        die();
            $data['masPoblacion'] = $resultado['max'];
            $data['menosPoblacion'] = $resultado['min'];
        }
        else{
            $data['datos'] = [];
            $data['error'] = 'No se ha podido cargar el fichero de datos.';
        }
        
        $this->view->showViews(array('templates/header-datatable.view.php', 'csv.view.php', 'templates/footer-datatable.view.php'), $data);
    }
    
    private function getMaxMin(array $datos) : array{
        $menosPoblacion = ['', '', '', 9999999999];
        $masPoblacion = ['', '', '', -1];
        
        foreach($datos as $fila){
            if(is_numeric($fila[3])){
                $poblacion = str_replace('.', '', $fila[3]);
                if($poblacion > str_replace('.', '', $masPoblacion[3])){
                    $masPoblacion = $fila;
                }
                if($poblacion < str_replace('.', '',$menosPoblacion[3])){
                    $menosPoblacion = $fila;
                }
            }
        }
        return [
            'max' => $masPoblacion,
            'min' => $menosPoblacion
        ];
    }
    
    function poblacionGruposEdad() : void{
        $data = [];
        $data['titulo'] = 'Población España grupos edad';
        $data['seccion'] = '/csv/grupos-edad';
        $modelo = new \Com\Daw2\Models\CSVModel();        
        $data['datos'] = $modelo->getPoblacionGruposEdad();
        if($data['datos'] === false){
            $data['datos'] = [];            
            $data['error'] = 'No se ha podido cargar el fichero de datos.';
        }
        $this->view->showViews(array('templates/header-datatable.view.php', 'csv-grupos.view.php', 'templates/footer-datatable.view.php'), $data);
    }
    
    function poblacion2020Totales() : void{
        $data = [];
        $data['titulo'] = 'Población Pontevedra Totales 2020';
        $data['seccion'] = '/csv/totales-2020';
        $modelo = new \Com\Daw2\Models\CSVModel();  
        $data['datos'] = $modelo->getTotales2020();
        if($data['datos'] !== false){
        
            $resultado = $this->getMaxMin($data['datos']);
    //        var_dump($masPoblacion);
    //        die();
            $data['masPoblacion'] = $resultado['max'];
            $data['menosPoblacion'] = $resultado['min'];
        }
        else{
            $data['datos'] = [];
            $data['error'] = 'No se ha podido cargar el fichero de datos.';
        }
        $this->view->showViews(array('templates/header-datatable.view.php', 'csv-municipio-poblacion.view.php', 'templates/footer-datatable.view.php'), $data);
    }
    
    function new2020Form() : void{
        $data = [];
        $data['titulo'] = 'Población Pontevedra Totales 2020';
        $data['seccion'] = '/csv/new-2020';
        $this->view->showViews(array('templates/header-datatable.view.php', 'new-2020.view.php', 'templates/footer-datatable.view.php'), $data);
    }
    
    function new2020FormProcess() : void{
        $data = [];
        $data['titulo'] = 'Población Pontevedra Totales 2020';
        $data['seccion'] = '/csv/new-2020';
        $data['errores'] = $this->checkFormNew2020($_POST);        
        if(count($data['errores']) === 0){
            $modelo = new \Com\Daw2\Models\CSVModel();  
            $exito = $modelo->insertPoblacion2020($_POST['municipio'], (int)$_POST['poblacion']);
            if(!$exito){
                $data['errores']['poblacion'] = 'No se ha logrado guardar. Inténtelo de nuevo.';
                $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
                $this->view->showViews(array('templates/header-datatable.view.php', 'new-2020.view.php', 'templates/footer-datatable.view.php'), $data);
            }
            else{
                header('Location: /csv/totales-2020?insertado='. urlencode($_POST['municipio']));
            }
        }
        else{
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header-datatable.view.php', 'new-2020.view.php', 'templates/footer-datatable.view.php'), $data);
        }
        
    }
    
    private function checkFormNew2020(array $post) : array{
        $errores = [];
        if(empty($post['municipio'])){
            $errores['municipio'] = "Campo obligatorio";
        }
        else if(!preg_match("/^[a-zA-Z][a-zA-Z\s]*$/", $post['municipio'])){
            $errores['municipio'] = "El nombre debe empezar por letra. Sólo se permiten letras y espacios.";    
        }
        
        if(empty($post['poblacion'])){
            $errores['poblacion'] = "Campo obligatorio";
        }
        else if(!filter_var($post['poblacion'], FILTER_VALIDATE_INT)){
            $errores['poblacion'] = "Debe insertar un número entero";
        }
        else if($post['poblacion'] <= 0){
            $errores['poblacion'] = "Debe insertar un valor mayor que cero";
        }
        return $errores;
    }
}