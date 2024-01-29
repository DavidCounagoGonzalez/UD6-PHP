<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
            
        Route::add('/',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->index();
            }
            , 'get');                           
                                              
        # Gestion de categorías           
        Route::add('/categorias',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->mostrarTodos();
                }
                , 'get');

        Route::add('/categorias/view/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->view($id);
                }
                , 'get');

        Route::add('/categorias/delete/([A-Za-z0-9]+)',
            function ($id) {
                $controlador = new \Com\Daw2\Controllers\CategoriaController();
                $controlador->delete($id);
            }
        , 'get');

        Route::add('/categorias/edit/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->mostrarEdit($id);
                }
                , 'get');

        Route::add('/categorias/edit/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->edit($id);
                }
                , 'post');

        Route::add('/categorias/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->mostrarAdd();
                }
                , 'get');

        Route::add('/categorias/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->add();
                }
                , 'post');

        Route::add('/categorias/cant_add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->cant_add();
                }
                , 'get');
                
        # Gestion de productos
        Route::add('/productos',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->mostrarTodos();
                }
                , 'get');
        Route::add('/productos/view/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->view($codigo);
                }
                , 'get');


        Route::add('/productos/delete/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->delete($codigo);
                }
                , 'get');


        Route::add('/productos/edit/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->mostrarEdit($codigo);
                }
                , 'get');

        Route::add('/productos/edit',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->processEdit();
                }
                , 'post');

        Route::add('/productos/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->mostrarAdd();
                }
                , 'get');

        Route::add('/productos/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->processAdd();
                }
                , 'post');

        # Gestion de proveedores

        Route::add('/proveedores',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->mostrarTodos();
                }
                , 'get');

        Route::add('/proveedores/view/([A-Za-z0-9]+)',
                function ($cif) {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->view($cif);
                }
                , 'get');

        Route::add('/proveedores/delete/([A-Za-z0-9]+)',
                function ($cif) {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->delete($cif);
                }
                , 'get');


        Route::add('/proveedores/edit/([A-Za-z0-9]+)',
                function ($cif) {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->mostrarEdit($cif);
                }
                , 'get');

        Route::add('/proveedores/edit/([A-Za-z0-9]+)',
                function ($cif) {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->edit($cif);
                }
                , 'post');

        Route::add('/proveedores/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->mostrarAdd();
                }
                , 'get');

        Route::add('/proveedores/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->add();
                }
                , 'post');

        Route::add('/proveedores/cant_add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->cant_add();
                }
                , 'get');
                
        Route::add('/usuarios-sistema',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->mostrarTodos();
                }
                , 'get');
                
        Route::add('/usuarios-sistema/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->mostrarAdd();
                }
                , 'get');
                
        Route::add('/usuarios-sistema/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->processAdd();
                }
                , 'post');


        Route::pathNotFound(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error404();
            }
        );

        Route::methodNotAllowed(
                function () {
                    $controller = new \Com\Daw2\Controllers\ErroresController();
                    $controller->error405();
                }
        );
        Route::run();
    }

}
