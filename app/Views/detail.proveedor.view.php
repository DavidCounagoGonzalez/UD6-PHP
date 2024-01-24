<!-- Content Row -->

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos completos del proveedor</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">                   
                <!-- <form method="get"> -->
                    <div class="row">
                    <div class="mb-3 col-sm-6">
                        <label for="cif">CIF</label>
                        <input class="form-control-plaintext" id="cif" type="text" name="cif" placeholder="<?php echo $proveedor['cif'] ?>" disabled>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="codigo">Código</label>
                        <input class="form-control-plaintext" id="codigo" type="text" name="codigo" placeholder="<?php echo $proveedor['codigo'] ?>" disabled>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="nombre">Nombre</label>
                        <input class="form-control-plaintext" id="nombre" type="text" name="nombre" placeholder="<?php echo $proveedor['nombre'] ?>" disabled>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="direccion">Dirección</label>
                        <input class="form-control-plaintext" id="direccion" type="text" name="direccion" placeholder="<?php echo $proveedor['direccion'] ?>" disabled>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="pais">País</label>
                        <input class="form-control-plaintext" id="pais" type="text" name="pais" placeholder="<?php echo $proveedor['pais'] ?>" disabled>
                    </div>
                    
                    <div class="mb-3 col-sm-6">
                        <label for="email">Email</label>
                        <input class="form-control-plaintext" id="email" type="email" name="email" placeholder="<?php echo $proveedor['email'] ?>" disabled>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="username">Teléfono</label>
                        <input class="form-control-plaintext" id="telefono" type="tel" name="telefono" placeholder="<?php echo $proveedor['telefono'] ?>" disabled>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="website">Website</label>
                        <input class="form-control-plaintext" id="website" type="url" name="website" placeholder="<?php echo $proveedor['website'] ?>" disabled>
                    </div>
                    <div class="mb-3 col-sm-9"></div>                   
                    <div class="mb-3 m-1">
                        <a href="/proveedores" class="btn btn-default">Volver</a>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>