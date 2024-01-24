<!-- Content Row -->

<div class="row">
    <?php 
    $actual = $categorias[0];
     $controller = new \Com\Daw2\Controllers\CategoriaController();
     ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Mostrando categoría <?php echo $actual['nombre_categoria'] ?></h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                    <!--form method="get"-->
                    <div class="row">
                        <div class="mb-3 col-sm-2">
                            <label for="id_categoria">ID Categoría</label>
                            <input class="form-control-plaintext" id="id_categoria" type="text" name="id_categoria" placeholder="<?php echo $actual['id_categoria'] ?>" disabled>
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label for="nombre_categoria">Nombre</label>
                            <input class="form-control-plaintext" id="nombre_categoria" type="text" name="nombre_categoria" placeholder="<?php echo $actual['nombre_categoria'] ?>" disabled>
                        </div>
                        <div class="mb-3 col-sm-2">
                            <label for="id_padre">ID Padre</label>
                            <input class="form-control-plaintext" id="id_padre" type="text" name="id_padre" placeholder="<?php echo $actual['id_padre'] ?>" disabled>                         
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label>Nombre Padre</label>
                            <input class="form-control-plaintext" type="text"placeholder="<?php 
                                 if ($actual['id_padre'] !== null) {
                                     echo $controller->getNombreCategoria($actual['id_padre']);
                                 }
                            ?>" disabled>                         
                        </div>

                        <div class="mb-3 col-sm-9"></div>
                    <div class="mb-3 m-1">
                        <a href="/categorias" class="btn btn-default">Volver</a>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>