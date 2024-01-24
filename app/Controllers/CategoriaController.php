<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class CategoriaController extends \Com\Daw2\Core\BaseController {

    function mostrarTodos() {
        $data = [];
        $data['titulo'] = 'Todas las categorías';
        $data['seccion'] = '/categorias';
        
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $aux = $modelo->getAll();        
        $res = [];
        foreach($aux as $c){
            $res[] = $modelo->loadCategoria($c['id_categoria']);
        }
        //var_dump($res); die();
        $data['categorias'] = $res;

        $this->view->showViews(array('templates/header.view.php', 'categorias.view.php', 'templates/footer.view.php'), $data);
    }
    
     function size() : int {
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        return $modelo->size();
    }

    function getNombreCategoria(string $id): string {
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $toret =  $modelo->getNombreCategoria($id)[0];
        return $toret['nombre_categoria'];
    }

    function mostrarAdd() {
        $data = [];
        $data['titulo'] = 'Nueva categoría';
        $data['seccion'] = '/categorias/add';
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $data['categorias'] = $modelo->getAllCategorias();
        $this->view->showViews(array('templates/header.view.php', 'add.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function mostrarEdit($id) {
        $data = [];
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $data['categorias'] = $modelo->getAllCategorias();
        $data['titulo'] = 'Categoría ' . $this->getNombreCategoria($id) . ' con ID: ' . $id;
        $data['categoria'] = $modelo->showEdit($id);
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

    function view(string $id) {
        $data = [];
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $data['titulo'] = 'Categoría ' . $this->getNombreCategoria($id) . ' con ID: ' . $id;
        $data['categorias'] = $modelo->view($id);

        $this->view->showViews(array('templates/header.view.php', 'detail.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function add(): void {
        $data = [];
        $data['titulo'] = 'Nueva Categoría';
        $data['seccion'] = '/categorias/add';
        $data['errores'] = $this->checkFormAdd($_POST);
        if (count($data['errores']) === 0) {
            $modelo = new \Com\Daw2\Models\CategoriaModel();
            $result = $modelo->add($_POST['id_categoria'], $_POST['nombre_categoria'], $_POST['id_padre']);

            if ($result == 1) {
                header('Location: /categorias');
            } else if ($result == 0) {
                header('Location: /categorias/cant_add');
            } else {
                header('location: methodNotAllowed');
            }
        } else {
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header-datatable.view.php', 'add.categoria.view.php', 'templates/footer-datatable.view.php'), $data);
        }
    }

    function cant_add() {
        $data = [];
        $data['titulo'] = 'No se puede crear la categoría debido a que el ID ya existe.';
        $data['seccion'] = '/categorias/add';
        $this->view->showViews(array('templates/header.view.php', 'add.categoria.view.php', 'templates/footer.view.php'), $data);
    }

    function edit($id): void {
        $data = [];
        $data['titulo'] = 'Categoria con ID ' . $id;
        $data['seccion'] = '/categoria/edit/' . $id;
        $data['errores'] = $this->checkFormAdd($_POST);
        if (count($data['errores']) === 0) {
            $modelo = new \Com\Daw2\Models\CategoriaModel();
            $result = $modelo->edit($_POST['id_categoria'], $_POST['nombre_categoria'], $_POST['id_padre'], $id);
            if ($result) {
                header('Location: /categorias');
            } else {
                $this->cant_edit($id);
            }
        } else {
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
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
        if (empty($post['id_categoria'])) {
            $errores['id_categoria'] = "Campo obligatorio";
        } else if (!preg_match("/[0-9]{1,11}/", $post['id_categoria'])) {
            $errores['id_categoria'] = "El ID solo puede contener números enteros hasta 11 cifras como máximo.";
        }

        if (empty($post['nombre_categoria'])) {
            $errores['nombre_categoria'] = "Campo obligatorio";
        }

        return $errores;
    }

}
