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
        $errores = $this->checkForm($_POST);
        if (count($errores) > 0) {
            $rolModel = new \Com\Daw2\Models\AuxRolModel();
            $idiomaModel = new \Com\Daw2\Models\AuxIdiomaModel();

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
            
            $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
            $saneado = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            if ($modelo->insertUsers($saneado)) {  
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

    private function checkForm(array $post) {
        $errores = [];
        if (empty($post['nombre'])) {
            $errores['nombre'] = 'Debe introducir un nombre';
        }else if(!preg_match('/[a-zA-Z_ ]{4}/', $post['nombre'])){
            $errores['nombre'] = 'El nombre debe contener entre 4 y 255 caracteres y estar formado por letras, espacios o _';
        }

        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no es válido';
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
        
        if(empty($post['idioma'])){
            $errores['idioma'] = "Por favor, selecciona un pais";
        }else{
            $idiomaModel = new \Com\Daw2\Models\AuxIdiomaModel();
            if(!filter_var($post['idioma'], FILTER_VALIDATE_INT) || is_null($idiomaModel->loadIdioma((int) $post['idioma']))){
                $errores['idioma'] = 'Valor incorrecto';
            }
        }
        
        return $errores;
    }
}
