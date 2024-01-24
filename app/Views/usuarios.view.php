<div class="row">       
    <?php
    if (isset($error)) {
        ?>
        <div class="col-12">
            <div class="alert alert-danger"><p><?php echo $error; ?></p></div>
        </div>
        <?php
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="/usuarios">
                <input type="hidden" name="order" value="<?php echo (isset($_GET['order']) && filter_var($_GET['order'], FILTER_VALIDATE_INT)) ? $_GET['order'] : ''; ?>"/>
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>                                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="rol">Tipo:</label>
                                <select name="rol[]" id="rol" class="form-control select2" data-placeholder="Roles" multiple>
                                    <option value="">-</option>
                                    <?php
                                    foreach ($roles as $rol) {
                                        ?>
                                        <option value="<?php echo $rol['id_rol']; ?>" <?php echo (isset($_GET['rol']) && in_array($rol['id_rol'], $_GET['rol'])) ? 'selected' : ''; ?>><?php echo ucfirst($rol['nombre_rol']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                                                          
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Nombre usuario:</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($input['username']) ? $input['username'] : ''; ?>" />
                            </div>
                        </div>     
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="salarioBruto">Salario Bruto:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="min_salar" id="min_salar" value="<?php echo isset($input['min_salar']) ? $input['min_salar'] : ''; ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_salar" id="max_salar" value="<?php echo isset($input['max_salar']) ? $input['max_salar'] : ''; ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="retencion">Retención:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="min_retencion" id="min_retencion" value="<?php echo isset($input['min_retencion']) ? $input['min_retencion'] : ''; ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_retencion" id="max_retencion" value="<?php echo isset($input['max_retencion']) ? $input['max_retencion'] : ''; ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/usuarios" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php
                if (count($usuarios) > 0) {
                    ?>
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <table id="tabladatos" class="table table-striped">                    
                        <thead>
                            <tr>
                                <th><a href="/usuarios?order=1<?php echo $queryString; ?>">Nombre usuario</a></th>
                                <th><a href="/usuarios?order=2<?php echo $queryString; ?>">Rol</a></th>
                                <th><a href="/usuarios?order=3<?php echo $queryString; ?>">Salario bruto</a></th>
                                <th><a href="/usuarios?order=4<?php echo $queryString; ?>">Retención</a></th>  
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($usuarios as $usuario) {
                                ?>
                                <tr class="<?php echo!$usuario['activo'] ? 'table-danger' : ''; ?>">
                                    <td><?php echo $usuario['username']; ?></td>
                                    <td><?php echo $usuario['nombre_rol']; ?></td>
                                    <td><?php echo number_format($usuario['salarioBruto'], 2, ',', '.'); ?></td>
                                    <td><?php echo $usuario['retencionIRPF']; ?></td>     
                                    <td><a href="/usuarios/delete/<?php echo $usuario['username']; ?>" target="_blank" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>                    
                    </table>
                    <?php
                } else {
                    ?>
                    <p class="text-danger">No existen registros que cumplan los requisitos.</p>
                    <?php
                }
                ?>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                        if($paginaActual > 1){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="/usuarios?page=1<?php echo $queryPage; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">First</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/usuarios?page=<?php echo $paginaActual - 1; ?><?php echo $queryPage; ?>" aria-label="Previous">
                                <span aria-hidden="true">&lt;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php
                        }
                        ?>                        
                        <li class="page-item active"><a class="page-link" href="#"><?php echo $paginaActual; ?></a></li>   
                        <?php
                        if($paginaActual < $numPaginas){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="/usuarios?page=<?php echo $paginaActual + 1; ?><?php echo $queryPage; ?>" aria-label="Next">
                                <span aria-hidden="true">&gt;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/usuarios?page=<?php echo $numPaginas; ?><?php echo $queryPage; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Last</span>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>                        
</div>
