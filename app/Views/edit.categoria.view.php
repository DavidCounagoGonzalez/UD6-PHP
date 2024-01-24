<!-- Content Row -->

<div class="row">
    <?php
    $actual = $categoria[0];
    $controller = new \Com\Daw2\Controllers\CategoriaController();
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Editando <?php echo $actual['nombre_categoria'] ?></h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="/categorias/edit/<?php echo $actual['id_categoria'] ?>" method="post">         
                    <!--form method="get"-->
                    <div class="row">                        
                        <input id="id_categoria" type="hidden" name="id_categoria"value="<?php echo isset($input['id_categoria']) ? $input['id_categoria'] : $actual['id_categoria']; ?>"/>                            
                        <div class="mb-3 col-sm-5">
                            <label for="codigo">Nombre</label>
                            <input class="form-control" id="nombre_categoria" type="text" name="nombre_categoria" placeholder="<?php echo $actual['nombre_categoria'] ?>" value="<?php echo isset($input['nombre_categoria']) ? $input['nombre_categoria'] : $actual['nombre_categoria']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['nombre_categoria']) ? $errores['nombre_categoria'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label for="nombre">Categoría Padre</label>
                            <select class="form-control select2-container--default" name="id_padre">
                                <?php
                                if ($actual['id_padre'] !== null) {
                                    ?>
                                    <option value="<?php $actual['id_padre'] ?>" selected><?php echo $controller->getNombreCategoria($actual['id_padre']); ?> </option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="" selected>[Sin categoría padre] </option>
                                    <?php
                                }
                                ?>
                                <?php
                                if (count($categorias) > 0) {
                                    foreach ($categorias as $c) {
                                        ?>
                                        <option value="<?php echo $c['id_categoria'] ?>"><?php echo $c['id_categoria'] . ': ' . $c['nombre_categoria'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <p class="text-danger"><?php echo isset($errores['id_padre']) ? $errores['id_padre'] : ''; ?></p>

                        </div>

                        <div class="col-12 text-right">                            
                            <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                            <a href="/categorias" class="btn btn-danger ml-3">Cancelar</a>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>