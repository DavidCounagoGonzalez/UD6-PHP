<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class UsuarioSistemaController extends \Com\Daw2\Core\BaseController {

    function mostrarTodos() {
        $data = [];
        $data['titulo'] = 'Todos los usuarios';
        $data['seccion'] = '/usuarios-sistema';

        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $data['usuarios'] = $modelo->getAll();

        $this->view->showViews(array('templates/header.view.php', 'usuario_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    function mostrarAdd() {
        $data = [];
        $data['titulo'] = 'Alta Usuario';
        $data['seccion'] = '/usuarios-sistema/add';
        $data['tituloDiv'] = 'Alta usuario';

        $rolModel = new \Com\Daw2\Models\AuxRolModel();
        $data['roles'] = $rolModel->getAll();

        $idiomaModel = new \Com\Daw2\Models\AuxIdiomaModel();
        $data['idiomas'] = $idiomaModel->getAll();

        $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data['input'] = $input;

        $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
    }
    
    function processAdd() {
        $errores = $this->checkInsert($_POST);
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $rolModel = new \Com\Daw2\Models\AuxRolModel();
        $idiomaModel = new \Com\Daw2\Models\AuxIdiomaModel();
        if (count($errores) > 0) {
            

            $data = array(
                'titulo' => 'Insertar usuarios',
                'seccion' => '/usuarios-sistema/add',
                'tituloDiv' => 'Alta usuarios',
                'roles' => $rolModel->getAll(),
                'idiomas' => $idiomaModel->getAll(),
                'input' => filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS),
                'errores' => $errores
            );
            $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
        } else {
            
            if ($modelo->insertUsers($_POST)) {  
                header('location: /usuarios-sistema');
            } else {
                $data = array(
                    'titulo' => 'Insertar usuarios',
                    'seccion' => '/usuarios-sistema/add',
                    'tituloDiv' => 'Alta usuarios',
                    'roles' => $rolModel->getAll(),
                    'idiomas' => $idiomaModel->getAll(),
                    'input' => filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS),
                    'errores' => "Error indeterminado al guardar los cambios"
                );
                $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
            }
        }
    }
    
    function mostrarEdit(int $id){
        $data = [];
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $input = $modelo->loadByUser($id);
        if(is_null($input)){
            header('location: /usuarios-sistema');
        }else{
            $data['titulo'] = 'Editar Usuario';
            $data['seccion'] = '/usuarios-sistema/edit/' . $id;
            $data['tituloDiv'] = 'Editar Usuario';

            $rolModel = new \Com\Daw2\Models\AuxRolModel();
            $data['roles'] = $rolModel->getAll();

            $idiomaModel = new \Com\Daw2\Models\AuxIdiomaModel();
            $data['idiomas'] = $idiomaModel->getAll();
            
            $data['input'] = $input;

            $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
        }
    }

    function processEdit(int $id){
        $errores = $this->checkUpdate($_POST, $id);
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $rolModel = new \Com\Daw2\Models\AuxRolModel();
        $idiomaModel = new \Com\Daw2\Models\AuxIdiomaModel();
        if(empty($_POST['pass'])){
            unset($errores['pass']);
        }
        
        if(count($errores) > 0){
            
            $data = array(
                'titulo' => 'Editar usuarios',
                'seccion' => '/usuarios-sistema/edit/' . $id,
                'tituloDiv' => 'Editar usuarios',
                'roles' => $rolModel->getAll(),
                'idiomas' => $idiomaModel->getAll(),
                'input' => $_POST,
                'errores' => $errores
            );
            $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
        }else{
            if($modelo->updateUsers($_POST, $id)){
                if(!is_null($_POST['pass'])){
                    $modelo->updatePass($_POST, $id);
                }
                header('location: /usuarios-sistema');
            }else{
                
                $data = array(
                    'titulo' => 'Editar usuarios',
                    'seccion' => '/usuarios-sistema/edit/' . $id,
                    'tituloDiv' => 'Editar usuarios',
                    'roles' => $rolModel->getAll(),
                    'idiomas' => $idiomaModel->getAll(),
                    'input' => $modelo->loadByUser($id),
                    'errores' => "Error indeterminado al guardar los cambios"
                );
                $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
                
            }
        }
    }
    
    
    private function checkInsert(array $post) {
        $errores = $this->checkForm($post);
        
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no es válido';
        }else{
            $model = new \Com\Daw2\Models\UsuarioSistemaModel();
            $usuario = $model->loadByEmail($post['email']);
            if(!is_null($usuario)){
                $errores['email'] = 'El email introducido está en uso.';
            }
        }
        
        return $errores;
    }
    
    private function checkUpdate(array $post, int $id) {
        $errores = $this->checkForm($post);
        
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no es válido';
        }else{
            $model = new \Com\Daw2\Models\UsuarioSistemaModel();
            $usuario = $model->getEditEmail($post, $id);
            if(!is_null($usuario)){
                $errores['email'] = 'El email introducido está en uso.';
            }
        }
        
        return $errores;
    }

    private function checkForm(array $post) {
        $errores = [];
        if (empty($post['nombre'])) {
            $errores['nombre'] = 'Debe introducir un nombre';
        }else if(!preg_match('/[a-zA-Z_ ]{4}/', $post['nombre'])){
            $errores['nombre'] = 'El nombre debe contener entre 4 y 255 caracteres y estar formado por letras, espacios o _';
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $post['pass'])) {
            $errores['pass'] = 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y como mínimo 8 caracteres.';
        }else if ($post['pass'] != $post['passRepe']) {
            $errores['passRepe'] = 'Las contraseñas no coinciden';
        }
        
        if(empty($post['id_rol'])){
            $errores['id_rol'] = "Por favor, selecciona un rol";
        }else{
            $rolModel = new \Com\Daw2\Models\AuxRolModel();
            if(!filter_var($post['id_rol'], FILTER_VALIDATE_INT) || is_null($rolModel->loadRol((int) $post['id_rol']))){
                $errores['id_rol'] = 'Valor incorrecto';
            }
        }
        
        if(empty($post['id_idioma'])){
            $errores['id_idioma'] = "Por favor, selecciona un pais";
        }else{
            $idiomaModel = new \Com\Daw2\Models\AuxIdiomaModel();
            if(!filter_var($post['id_idioma'], FILTER_VALIDATE_INT) || is_null($idiomaModel->loadIdioma((int) $post['id_idioma']))){
                $errores['id_idioma'] = 'Valor incorrecto';
            }
        }
        
        return $errores;
    }
}
