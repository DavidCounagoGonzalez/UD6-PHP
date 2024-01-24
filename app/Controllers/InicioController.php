<?php

namespace Com\Daw2\Controllers;

class InicioController extends \Com\Daw2\Core\BaseController {

    public function index() {
        $data = array(
            'titulo' => 'Página de inicio',
            'breadcrumb' => ['Inicio']
        );        
        $modeloCategorias = new \Com\Daw2\Models\CategoriaModel();
        $data['numCategorias'] = $modeloCategorias->size();
        
        $modeloProductos = new \Com\Daw2\Models\ProductoModel();
        $data['numProductos'] = $modeloProductos->size();
        
        $modeloProveedores = new \Com\Daw2\Models\ProveedorModel();
        $data['numProveedores'] = $modeloProveedores->size();
        
        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }

}
