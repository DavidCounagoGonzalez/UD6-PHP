<!-- Content Row -->

<div class="row">    
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Editando <?php echo $proveedor['cif'] ?></h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="/proveedores/edit/<?php echo $proveedor['cif'] ?>" method="post">         
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="cif">CIF</label>
                            <input class="form-control-plaintext" id="cif" type="text" name="cif" placeholder="<?php echo $proveedor['cif'] ?>"  value="<?php echo $proveedor['cif']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['cif']) ? $errores['cif'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="codigo">Código</label>
                            <input class="form-control" id="codigo" type="text" name="codigo" placeholder="<?php echo $proveedor['codigo'] ?>" value="<?php echo isset($input['codigo']) ? $input['codigo'] : $proveedor['codigo']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['codigo']) ? $errores['codigo'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="nombre">Nombre</label>
                            <input class="form-control" id="nombre" type="text" name="nombre" placeholder="<?php echo $proveedor['nombre'] ?>" value="<?php echo isset($input['nombre']) ? $input['nombre'] : $proveedor['nombre']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['nombre']) ? $errores['nombre'] : ''; ?></p>

                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="direccion">Dirección</label>
                            <input class="form-control" id="direccion" type="text" name="direccion" placeholder="<?php echo $proveedor['direccion'] ?>" value="<?php echo isset($input['direccion']) ? $input['direccion'] : $proveedor['direccion']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['direccion']) ? $errores['direccion'] : ''; ?></p>

                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="pais">País</label>
                            <input class="form-control" id="pais" type="text" name="pais" placeholder="<?php echo $proveedor['pais'] ?>" value="<?php echo isset($input['pais']) ? $input['pais'] : $proveedor['pais']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['pais']) ? $errores['pais'] : ''; ?></p>

                        </div>

                        <div class="mb-3 col-sm-6">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" placeholder="<?php echo $proveedor['email'] ?>" value="<?php echo isset($input['email']) ? $input['email'] : $proveedor['email']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['email']) ? $errores['email'] : ''; ?></p>

                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="username">Teléfono</label>
                            <input class="form-control" id="telefono" type="tel" name="telefono" placeholder="<?php echo $proveedor['telefono'] ?>" value="<?php echo isset($input['telefono']) ? $input['telefono'] : $proveedor['telefono']; ?>">
                            <p class="text-danger"><?php echo isset($errores['telefono']) ? $errores['telefono'] : ''; ?></p>

                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="website">Website</label>
                            <input class="form-control" id="website" type="url" name="website" placeholder="<?php echo $proveedor['website'] ?>" value="<?php echo isset($input['website']) ? $input['website'] : $proveedor['website']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['website']) ? $errores['website'] : ''; ?></p>

                        </div>
                        <div class="col-12 text-right">                            
                            <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                            <a href="/proveedores" class="btn btn-danger ml-3">Cancelar</a>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>