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
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="col-6">
                <h6 class="m-0 installfont-weight-bold text-primary">Proveedores</h6> 
                </div>
                <div class="col-6">                       
                    <div class="m-0 font-weight-bold justify-content-end">
                        <a href="/categorias/add/" class="btn btn-primary ml-1 float-right"> Nueva Categoría <i class="fas fa-plus-circle"></i></a>
                    </div>                    
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php
                if (count($categorias) > 0) {                    
                    ?>
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <table id="tabladatos" class="table table-striped">                    
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>                                                                                   
                                <th>Ruta completa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($categorias as $c) {
                                ?>
                                <tr class="<?php #echo $p['pais'] != 'España' ? 'table-warning' :  '';  ?>">
                                    <td><?php echo $c['id_categoria']; ?></td>
                                    <td><?php echo $c['nombre_categoria']; ?></td>                                     
                                    <td><?php echo $c['fullName']; ?></td>   
                                    <td> 
                                        <a href="/categorias/view/<?php echo $c['id_categoria']; ?>" class="btn btn-default ml-1"><i class="fas fa-eye"></i></a>
                                        <a href="/categorias/edit/<?php echo $c['id_categoria']; ?>" class="btn btn-success ml-1"><i class="fas fa-edit"></i></a>
                                        <a href="/categorias/delete/<?php echo $c['id_categoria']; ?>" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a>
                                    </td>

                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            Total de registros: <?php echo count($categorias); ?>
                        </tfoot>
                    </table>
                    <?php
                } else {
                    ?>
                    <p class="text-danger">No existen registros que cumplan los requisitos.</p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>                        
</div>
