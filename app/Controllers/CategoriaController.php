<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class CategoriaController extends \Com\Daw2\Core\BaseController {

    function mostrarTodos() {
        $data = [];
        $data['titulo'] = 'Todas las categorías';
        $data['seccion'] = '/categorias';
        
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $res = $modelo->getAll();        

        //var_dump($res); die();
        $data['categorias'] = $res;

        $this->view->showViews(array('templates/header.view.php', 'categorias.view.php', 'templates/footer.view.php'), $data);
    }
    
     function size() : int {
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        return $modelo->size();
    }

    function mostrarAdd() {
        $data = [];
        $data['titulo'] = 'Nueva categoría';
        $data['seccion'] = '/categorias/add';
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $data['categorias'] = $modelo->getAllCategorias();
        $this->view->showViews(array('templates/header.view.php', 'edit.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function mostrarEdit(int $id) {
        $data = [];
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $categoria = $modelo->loadCategoria($id);
        $data['categorias'] = $modelo->getAllCategorias();
        $data['titulo'] = 'Categoría ' . $categoria['fullName'];
        $data['input'] = $categoria;
        $data['categorias'] = $modelo->getAllMinus($id);
        $this->view->showViews(array('templates/header.view.php', 'edit.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function delete(string $id) {
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $result = $modelo->delete($id);
        if ($result == 1) {
            header('Location: /categorias');
        } else if ($result == 0) {
            $this->cant_delete($id);
        } else {
            header('location: methodNotAllowed');
        }
    }

    function cant_delete(string $id) {
        $data = [];
        $data['titulo'] = 'No se ha podido borrar la categoria con id: ' . $id . ' debido a que tiene productos asociados.';
        $data['seccion'] = '/categorias';
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $data['categorias'] = $modelo->view($id);

        $this->view->showViews(array('templates/header.view.php', 'detail.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function view(int $id) {
        $data = [];
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $data['actual'] = $modelo->loadCategoria($id);
        $data['titulo'] = 'Categoría ' . $data['actual']['nombre_categoria'] . ' con ID: ' . $id;        

        $this->view->showViews(array('templates/header.view.php', 'detail.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function add(): void {
        $data = [];
        $data['titulo'] = 'Nueva Categoría';
        $data['seccion'] = '/categorias/add';
        $data['errores'] = $this->checkFormAdd($_POST);
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        //var_dump($data['errores']);die;
        if (count($data['errores']) === 0) {            
            $idPadre = (is_null($_POST['id_padre'])) ? null : (int)$_POST['id_padre'];
            $result = $modelo->add((int)$_POST['id_categoria'], $_POST['nombre_categoria'], $idPadre);

            if ($result == 1) {
                header('Location: /categorias');
            } else {
                header('Location: /categorias/cant_add');
            } 
        } else {
            $data['categorias'] = $modelo->getAllCategorias();
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header-datatable.view.php', 'edit.categoria.view.php', 'templates/footer-datatable.view.php'), $data);
        }
    }

    function cant_add() {
        $data = [];
        $data['titulo'] = 'No se puede crear la categoría debido a que el ID ya existe.';
        $data['seccion'] = '/categorias/add';
        $this->view->showViews(array('templates/header.view.php', 'add.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function edit(int $id): void {
        $data = [];
        $data['titulo'] = 'Categoria con ID ' . $id;
        $data['seccion'] = '/categoria/edit/' . $id;
        $data['errores'] = $this->checkFormAdd($_POST);
        if (count($data['errores']) === 0) {
            $modelo = new \Com\Daw2\Models\CategoriaModel();
            $idPadre = filter_var($_POST['id_padre'], FILTER_VALIDATE_INT) ? (int)$_POST['id_padre'] : null;
            $result = $modelo->edit($id, $_POST['nombre_categoria'], $idPadre);
            if ($result) {
                header('Location: /categorias');
            } else {
                $this->cant_edit($id);
            }
        } else {
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $modelo = new \Com\Daw2\Models\CategoriaModel();
            $data['categorias'] = $modelo->getAllMinus($id);
            $this->view->showViews(array('templates/header-datatable.view.php', 'edit.categoria.view.php', 'templates/footer-datatable.view.php'), $data);
        }
    }

    function cant_edit(string $id) {
        $data = [];
        $data['titulo'] = 'No se ha podido editar la categoria con ID ' . $id . '';
        $data['seccion'] = '/categorias';
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $data['categorias'] = $modelo->showEdit($id);

        $this->view->showViews(array('templates/header.view.php', 'edit.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function checkFormAdd(array $post): array {
        $errores = [];
        
        if (empty($post['nombre_categoria'])) {
            $errores['nombre_categoria'] = "Campo obligatorio";
        }

        return $errores;
    }

}
