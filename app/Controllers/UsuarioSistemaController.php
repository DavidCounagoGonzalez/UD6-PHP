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

    function userAdd() {
        $errores = $this->checkForm($_POST);
        if (count($errores) > 0) {
            var_dump($errores);
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
        if (strlen($post['nombre']) == 0) {
            $errores['nombre'] = 'Debe introducir un nombre';
        }

        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no es válido';
        }

        if (strlen($post['pass']) < 8) {
            $errores['pass'] = 'La contraseña debe contener al menos 8 caracteres';
        } else if (!preg_match('/.*[A-Z]/', $post['pass'])) {
            $errores['pass'] .= 'La contraseña debe contener al menos una mayúscula.';
        } else if (!preg_match('/.*[a-z]/', $post['pass'])) {
            $errores['pass'] .= 'La contraseña debe contener al menos una minúscula.';
        } else if (!preg_match('/.*[\d]+/', $post['pass'])) {
            $errores['pass'] .= 'La contraseña debe contener al menos un dígito.';
        }

        if ($post['pass'] != $post['passRepe']) {
            $errores['passRepe'] = 'Las contraseñas no coinciden';
        }
        
        return $errores;
    }
}
