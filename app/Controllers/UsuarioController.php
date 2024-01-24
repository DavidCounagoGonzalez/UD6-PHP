<?php
declare(strict_types = 1);
namespace Com\Daw2\Controllers;

class UsuarioController extends \Com\Daw2\Core\BaseController {
        
    function mostrarTodos(){
        $data = [];
        $data['titulo'] = 'Todos los usuarios';
        $data['seccion'] = '/usuarios';        
        
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $rolModel = new \Com\Daw2\Models\AuxRolModel();
        $data['roles'] = $rolModel->getAll();
        $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);        
        
        $copiaGet = $_GET;
        unset($copiaGet['order']);
        unset($copiaGet['page']);
        if(count($copiaGet) > 0){
            $data['queryString'] = '&'.http_build_query($copiaGet);
        }
        else{
            $data['queryString'] = '';
        }
        
        $getOrder = $_GET;
        unset($getOrder['page']);
        if(count($getOrder) > 0){
            $data['queryPage'] = '&'.http_build_query($getOrder);
        }
        else{
            $data['queryPage'] = '';
        }
        
        $data['paginaActual'] = (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) && $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
        
        $numRegistros = $modelo->count($_GET);
        $paginas = floor(($numRegistros / (int)$_ENV['table.rowsPerPage']));
        if($numRegistros % (int)$_ENV['table.rowsPerPage'] != 0){
            $paginas++;
        }
        $data['numPaginas'] = $paginas;
        //var_dump($modelo->count($_GET)); die();
        $data['usuarios'] = $modelo->get($_GET, (int)$_ENV['table.rowsPerPage']);
        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    function delete(string $username){
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        if($modelo->delete($username)){
            header('Location: /usuarios');
        }
        else{
            echo 'no se ha borrado';
        }
    }
      
    function mostrarTodosOrdenados(){
        $data = [];
        $data['titulo'] = 'Usuarios ordenados por salario';
        $data['seccion'] = '/usuarios/ordered';
        
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $data['usuarios'] = $modelo->getAllOrdenados();
        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    function mostrarUsuariosStandard(){
        $data = [];
        $data['titulo'] = 'Usuarios estándard';
        $data['seccion'] = '/usuarios/estandard';
        
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $data['usuarios'] = $modelo->getStandard();
        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    function mostrarUsuariosCarlos(){
        $data = [];
        $data['titulo'] = 'Usuarios Carlos';
        $data['seccion'] = '/usuarios/carlos';
        
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $data['usuarios'] = $modelo->getCarlos();
        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
}