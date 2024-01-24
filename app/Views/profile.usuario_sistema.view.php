<!-- Content Row -->

<div class="row">
    <?php
    $usuario = $usuarios_sistema[0];
    $controller = new \Com\Daw2\Controllers\UsuarioSistemaController();
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos personales</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">                   
                <!-- <form method="get"> -->
                <div class="row">
                    <div class="mb-3 col-sm-1">
                        <label for="id_usuario">ID</label>
                        <input class="form-control-plaintext" id="id_usuario" type="text" name="id_usuario" placeholder="<?php echo $usuario['id_usuario'] ?>" disabled>
                    </div>
                    <div class="mb-3 col-sm-2">
                        <label for="nombre">Nombre</label>
                        <input class="form-control-plaintext" id="nombre" type="text" name="nombre" placeholder="<?php echo $usuario['nombre'] ?>" disabled>
                    </div>
                    <div class="mb-3 col-sm-2">
                        <label for="id_rol">Rol</label>
                        <input class="form-control-plaintext" id="id_rol" type="text" name="id_rol" placeholder="<?php echo $usuario['nombre_rol']; ?>" disabled>
                    </div>
                    <div class="mb-3 col-sm-4">
                        <label for="email">Email</label>
                        <input class="form-control-plaintext" id="email" type="email" name="email" placeholder="<?php echo $usuario['email'] ?>" disabled>
                    </div>
                    
                    <!--
                    <div class="mb-3 col-sm-4">
                        <label for="last_date">Última Conexión</label>
                        <input class="form-control-plaintext" id="last_date" type="text" name="last_date" placeholder="<?php echo $usuario['last_date'] ?>" disabled>
                    </div>
                    
                    <div class="mb-3 col-sm-2">
                        <label for="baja">Dado de Baja</label>
                        <input class="form-check-inline" id="baja" type="checkbox" name="baja" <?php if ($usuario['baja']) echo 'checked'; ?> disabled>
                        
                    </div>
                    -->
                    <div class="mb-3 col-sm-2">
                        <a href="/" class="btn btn-default">Volver al Inicio</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>                        
</div>