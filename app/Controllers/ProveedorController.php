<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class ProveedorController extends \Com\Daw2\Core\BaseController {

    function mostrarTodos() {
        $data = [];
        $data['titulo'] = 'Todos los proveedores';
        $data['seccion'] = '/proveedores';

        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $data['proveedores'] = $modelo->getAll();

        $this->view->showViews(array('templates/header.view.php', 'proveedores.view.php', 'templates/footer.view.php'), $data);
    }
    
    function size() : int {
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        return $modelo->size();
    }

    function mostrarAdd() {
        $data = [];
        $data['titulo'] = 'Nuevo proveedor';
        $data['seccion'] = '/proveedores/add';
        $this->view->showViews(array('templates/header.view.php', 'add.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    function mostrarEdit($cif) {
        $data = [];
        $data['titulo'] = 'Proveedor ' . $cif;
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $data['proveedor'] = $modelo->loadProveedor($cif);
        $this->view->showViews(array('templates/header.view.php', 'edit.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    function delete(string $cif) {
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $result = $modelo->delete($cif);
        if ($result == 1) {
            header('Location: /proveedores');
        } else if ($result == 0) {
            $this->cant_delete($cif);
        } else {
            header('location: methodNotAllowed');
        }
    }

    function cant_delete(string $cif) {
        $data = [];
        $data['titulo'] = 'No se ha podido borrar el proveedor con cif ' . $cif . ' debido a que tiene productos asociados.';
        $data['seccion'] = '/proveedores';
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $data['proveedor'] = $modelo->loadProveedor($cif);

        $this->view->showViews(array('templates/header.view.php', 'detail.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    function view(string $cif) {
        $data = [];
        $data['titulo'] = 'Proveedor ' . $cif;
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $data['proveedor'] = $modelo->loadProveedor($cif);

        $this->view->showViews(array('templates/header.view.php', 'detail.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    function add(): void {
        $data = [];
        $data['titulo'] = 'Nuevo Proveedor';
        $data['seccion'] = '/proveedores/add';
        $data['errores'] = $this->checkFormAdd($_POST);
        if (count($data['errores']) === 0) {
            $modelo = new \Com\Daw2\Models\ProveedorModel();
            $result = $modelo->add($_POST['cif'], $_POST['codigo'], $_POST['nombre'], $_POST['direccion'], $_POST['website'], $_POST['pais'], $_POST['email'], $_POST['telefono']);

            if ($result == 1) {
                header('Location: /proveedores');
            } else if ($result == 0) {
                header('Location: /proveedores/cant_add');
            } else {
                header('location: methodNotAllowed');
            }
        } else {
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header-datatable.view.php', 'add.proveedor.view.php', 'templates/footer-datatable.view.php'), $data);
        }
    }
    
    function cant_add() {
        $data = [];
        $data['titulo'] = 'No se puede crear el proveedor con un cif ya existente';
        $data['seccion'] = '/proveedores/add';
        $this->view->showViews(array('templates/header.view.php', 'add.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    function edit(string $cif): void {
        $data = [];
        $data['titulo'] = 'Proveedor con cif ' . $cif;
        $data['seccion'] = '/proveedor/edit/' . $cif;
        $data['errores'] = $this->checkFormAdd($_POST, $cif);
        if (count($data['errores']) === 0) {
            $modelo = new \Com\Daw2\Models\ProveedorModel();
            $result = $modelo->edit($cif, $_POST['codigo'], $_POST['nombre'], $_POST['direccion'], $_POST['website'], $_POST['pais'], $_POST['email'], $_POST['telefono']);          
            if ($result) {
                header('Location: /proveedores');
            } else {
                $this->cant_edit($cif);
            }
        } else {
            $data['proveedor'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header-datatable.view.php', 'edit.proveedor.view.php', 'templates/footer-datatable.view.php'), $data);
        }
    }

    function cant_edit(string $cif) {
        $data = [];
        $data['titulo'] = 'No se ha podido editar el proveedor con cif ' . $cif . '';
        $data['seccion'] = '/proveedores';
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $data['proveedores'] = $modelo->loadProveedor($cif);

        $this->view->showViews(array('templates/header.view.php', 'edit.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Comprueba que el formulario es válido
     * @param array $post Valores recibidos por post
     * @return array Array de errores
     */
    function checkFormAdd(array $post, string $cif = ''): array {
        $errores = [];
        if (empty($post['cif'])) {
            $errores['cif'] = "Campo obligatorio";
        } else if (!preg_match("/[a-zA-Z][0-9]{7}[a-zA-Z]/", $post['cif'])) {
            $errores['cif'] = "El cif debe seguir el siguiente formato: A0000000A";
        }
        else if($cif != '' && $cif != $post['cif']){
            $modelo = new \Com\Daw2\Models\ProveedorModel();
            $row = $modelo->loadProveedor($cif);
            if(!is_null($row)){
                $errores['cif'] = 'El cif se encuentra en uso por otro usuario';
            }
        }

        if (empty($post['codigo'])) {
            $errores['codigo'] = "Campo obligatorio";
        }

        if (empty($post['nombre'])) {
            $errores['nombre'] = "Campo obligatorio";
        }

        if (empty($post['website'])) {
            $errores['website'] = "Campo obligatorio";
        }

        if (empty($post['email'])) {
            $errores['email'] = "Campo obligatorio";
        }

        if (empty($post['pais'])) {
            $errores['pais'] = "Campo obligatorio";
        }

        if (empty($post['direccion'])) {
            $errores['direccion'] = "Campo obligatorio";
        }

        if (!preg_match("/[0-9+]+/", $post['telefono'])) {
            $errores['telefono'] = "El telefono debe tener un formato válido";
        }
        return $errores;
    }

}
