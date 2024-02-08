<!-- Content Row -->

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloDiv; ?></h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="<?php echo $seccion; ?>" method="post">         
                    <!--form method="get"-->
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="nombre">Nombre de usuario</label>
                            <input class="form-control" id="nombre" type="text" name="nombre" placeholder="Inserte un nombre" value="<?php echo isset($input['nombre']) ? $input['nombre'] : ''; ?>"<?php echo isset($readonly) ? 'readonly': ''; ?>>
                            <p class="text-danger"><?php echo isset($errores['nombre']) ? $errores['nombre'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="text" name="email" placeholder="miemail@dominio.org" value="<?php echo isset($input['email']) ? $input['email'] : ''; ?>"<?php echo isset($readonly) ? 'readonly': ''; ?>>
                            <p class="text-danger"><?php echo isset($errores['email']) ? $errores['email'] : ''; ?></p>
                        </div>
                        <?php if(!isset($readonly)){?>
                        <div class="mb-3 col-sm-6">
                            <label for="pass">Contraseña</label>
                            <input class="form-control" id="pass" type="password" name="pass" placeholder="Crea una contraseña" value="">
                            <p class="text-danger"><?php echo isset($errores['pass']) ? $errores['pass'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="pass">Confirmar Contraseña</label>
                            <input class="form-control" id="passRepe" type="password" name="passRepe" placeholder="Repite la contraseña" value="">
                            <p class="text-danger"><?php echo isset($errores['passRepe']) ? $errores['passRepe'] : ''; ?></p>
                        </div>
                        <?php } ?>
                        <div class="mb-3 col-sm-6">
                            <label for="id_rol">Rol del usuario</label>
                            <select class="form-control select2-container--default" name="id_rol" <?php echo isset($readonly) ? 'disabled': ''; ?>>
                                <option value="">-</option>
                                <?php
                                if (count($roles) > 0) {
                                    foreach ($roles as $r) {
                                        ?>
                                        <option value="<?php echo $r['id_rol'] ?>" <?php echo (isset($input['id_rol']) && $input['id_rol'] == $r['id_rol']) ? 'selected' : ''; ?>><?php echo  $r['nombre_rol'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <p class="text-danger"><?php echo isset($errores['id_rol']) ? $errores['id_rol'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="idioma">Idioma</label>
                            <select class="form-control" name="id_idioma" <?php echo isset($readonly) ? 'disabled': ''; ?>>
                                <option value="">-</option>                                
                                <?php
                                if (count($idiomas) > 0) {
                                    foreach ($idiomas as $i) {
                                        ?>
                                        <option value="<?php echo $i['id_idioma'] ?>" <?php echo (isset($input['id_idioma']) && $input['id_idioma'] == $i['id_idioma']) ? 'selected' : ''; ?>><?php echo  $i['nombre_idioma'] ?></option>
                                        <?php
                                    }
                                }
                                ?>                              
                            </select>
                            <p class="text-danger"><?php echo isset($errores['id_idioma']) ? $errores['id_idioma'] : ''; ?></p>
                        </div>
                        <div class="col-12 text-right">   
                            <?php if(!isset($readonly)){?>
                            <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                            <?php } ?>
                            <a href="/usuarios-sistema" class="btn btn-danger ml-3">Cancelar</a>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>