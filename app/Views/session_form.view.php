<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cubes mr-1"></i>
                        Cambio en el nombre de sesión. Nombre actual: <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '<i>Sin establecer</i>'; ?>
                    </h3>                
                </div>
                <form action="/session/form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <!-- select -->                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usuario">Nuevo nombre de usuario:</label>
                                    <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>" />
                                    <?php
                                    if(isset($errors['usuario'])){
                                    ?>
                                    <p class="text-danger"><small><?php echo $errors['usuario']; ?></small></p>
                                    <?php
                                    }
                                    ?>
                                </div> 
                            </div>

                        </div></div>
                    <div class="card-footer">
                        <button type="submit" name="action" class="btn btn-primary mr-3 float-right" value="guardar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



