<div class="row">       
    <?php
    if(isset($error)){
        ?>
    <div class="col-12">
        <div class="alert alert-danger"><p><?php echo $error; ?></p></div>
    </div>
    <?php
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                <div class="col-6">
                <h6 class="m-0 installfont-weight-bold text-primary">Proveedores</h6> 
                </div>
                <div class="col-6">
                   
                    <div class="m-0 font-weight-bold justify-content-end">
                        <a href="/proveedores/add/" class="btn btn-primary ml-1 float-right"> Nuevo Proveedor <i class="fas fa-plus-circle"></i></a>
                    </div>
                   
                </div>
                
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php 
                if(count($proveedores) > 0){                                    
                ?>
                <!--<form action="./?sec=formulario" method="post">                   -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th>CIF</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <!--
                            <th>Dirección</th>                            
                            <th>País</th>
                            -->
                            <th>Email</th>
                            <!--
                            <th>Teléfono</th>
                            -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($proveedores as $p){
                        ?>
                        <tr class="<?php #echo $p['pais'] != 'España' ? 'table-warning' :  ''; ?>">
                            <td><?php echo $p['cif']; ?></td>
                            <td><?php echo $p['codigo']; ?></td>
                            <td><?php echo $p['nombre']; ?> <a href="<?php echo $p['website']; ?>" target="_blank"><i class="text-sm ml-1 fas fa-external-link-alt"></i></a></td>
                            <td><a href="mailto:<?php echo $p['email']; ?>"><?php echo $p['email']; ?></a></td>                           
                            <td>  
                                <a href="/proveedores/view/<?php echo $p['cif']; ?>" class="btn btn-default ml-1"><i class="fas fa-eye"></i></a>
                                <a href="/proveedores/edit/<?php echo urlencode($p['cif']); ?>" class="btn btn-success ml-1"><i class="fas fa-edit"></i></a>                                
                                <a href="/proveedores/delete/<?php echo urlencode($p['cif']); ?>" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a>                                
                            </td>

                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        Total de registros: <?php echo count($proveedores); ?>
                    </tfoot>
                </table>
                <?php
                
                
                            }
                else{
                ?>
                <p class="text-danger">No existen registros que cumplan los requisitos.</p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>                        
</div>
