<!-- Content Row -->

<div class="row">
 <?php
    if(isset($errores)) {
        echo var_dump($errores);
        //var_dump($_POST);
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloDiv; ?></h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="<?php echo $seccion; ?>" method="post">         
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="codigo">Código</label>
                            <input class="form-control" id="nombre" type="text" name="codigo" placeholder="Código del producto" value="<?php echo isset($input['codigo']) ? $input['codigo'] : ''; ?>" <?php echo $seccion == '/productos/edit' || $seccion == '/productos/view' ? 'readonly' : '';?>>
                            <p class="text-danger"><?php echo isset($errores['codigo']) ? $errores['codigo'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="nombre">Nombre</label>
                            <input class="form-control" id="nombre" type="text" name="nombre" placeholder="Nombre del producto" value="<?php echo isset($input['nombre']) ? $input['nombre'] : ''; ?>" <?php echo $seccion == '/productos/view' ? 'readonly' : ''; ?>>
                            <p class="text-danger"><?php echo isset($errores['nombre']) ? $errores['nombre'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="proveedor">Proveedor</label>
                            <select class="form-control" name="proveedor" <?php echo $seccion == '/productos/view' ? 'readonly' : ''; ?>>
                                <option value="">-</option>
                                <?php                                
                                foreach ($proveedores as $p) {
                                    ?>
                                    <option value="<?php echo $p['cif'] ?>" <?php echo (isset($input['proveedor']) && $input['proveedor'] == $p['cif']) ? 'selected' : ''; ?>><?php echo $p['cif'].': '.$p['nombre'] ?></option>
                                    <?php
                                }                                
                                ?>
                            </select>
                            <p class="text-danger"><?php echo isset($errores['proveedor']) ? $errores['proveedor'] : ''; ?></p>
                        </div>                        
                        <div class="mb-3 col-sm-6">
                            <label for="id_categoria">Categoría</label>
                            <select class="form-control" name="id_categoria" <?php echo $seccion == '/productos/view' ? 'readonly' : ''; ?>>
                                <option value="">-</option>
                                <?php                                
                                foreach ($categorias as $c) {
                                    ?>
                                    <option value="<?php echo $c['id_categoria'] ?>" <?php echo (isset($input['id_categoria']) && $input['id_categoria'] == $c['id_categoria']) ? 'selected' : ''; ?>><?php echo $c['fullName'] ?></option>
                                    <?php
                                }                                
                                ?>
                            </select>
                            <p class="text-danger"><?php echo isset($errores['id_categoria']) ? $errores['id_categoria'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="coste">Coste</label>
                            <input class="form-control" id="coste" type="number" name="coste" placeholder="Coste del producto" value="<?php echo isset($input['coste']) ? $input['coste'] : ''; ?>" <?php echo $seccion == '/productos/view' ? 'readonly' : ''; ?>>
                            <p class="text-danger"><?php echo isset($errores['coste']) ? $errores['coste'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="margen">Margen</label>
                            <input class="form-control" id="margen" type="number" name="margen" placeholder="Margen a aplicar" value="<?php echo isset($input['margen']) ? $input['margen'] : ''; ?>" <?php echo $seccion == '/productos/view' ? 'readonly' : ''; ?>>
                            <p class="text-danger"><?php echo isset($errores['margen']) ? $errores['margen'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="iva">IVA</label>
                             <select class="form-control" name="iva" <?php echo $seccion == '/productos/view' ? 'readonly' : ''; ?>>
                                <option value="">-</option>
                                <?php                                
                                foreach ($ivas as $iva) {
                                    ?>
                                    <option value="<?php echo $iva; ?>" <?php echo (isset($input['iva']) && $input['iva'] != '' && $input['iva'] == $iva) ? 'selected' : ''; ?>><?php echo $iva ?></option>
                                    <?php
                                }                                
                                ?>
                            </select>
                            <p class="text-danger"><?php echo isset($errores['iva']) ? $errores['iva'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="margen">Stock</label>
                            <input class="form-control" id="stock" type="number" name="stock" placeholder="Stock actual" value="<?php echo isset($input['stock']) ? $input['stock'] : ''; ?>" <?php echo $seccion == '/productos/view' ? 'readonly' : ''; ?>>
                            <p class="text-danger"><?php echo isset($errores['stock']) ? $errores['stock'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" <?php echo $seccion == '/productos/view' ? 'readonly' : ''; ?>><?php echo isset($input['descripcion']) ? $input['descripcion'] : '';?></textarea>
                            <p class="text-danger"><?php echo isset($errores['descripcion']) ? $errores['descripcion'] : ''; ?></p>
                        </div>                        
                        <div class="col-12 text-right">                            
                            <?php
                            if($seccion != '/productos/view'){
                                ?>
                            <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                            <?php
                            }
                            ?>

                            <a href="/productos" class="btn btn-danger ml-3">Cancelar</a>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>