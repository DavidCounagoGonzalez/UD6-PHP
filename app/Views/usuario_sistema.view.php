<div class="row">           
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="col-6">
                <h6 class="m-0 installfont-weight-bold text-primary">Usuarios del sistema</h6> 
                </div>
                <div class="col-6">                       
                    <div class="m-0 font-weight-bold justify-content-end">
                        <a href="/usuarios-sistema/add/" class="btn btn-primary ml-1 float-right"> Nuevo usuario <i class="fas fa-plus-circle"></i></a>
                    </div>                    
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php 
                if(count($usuarios) > 0){                                    
                ?>
                <!--<form action="./?sec=formulario" method="post">                   -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>                          
                            <th>Rol</th>                            
                            <th>Idioma</th>
                            <th>Última conexión</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($usuarios as $u){
                        ?>
                        <tr class="<?php #echo $p['pais'] != 'España' ? 'table-warning' :  ''; ?>">
                            <td><?php echo $u['nombre']; ?></td>
                            <td><a href="mailto: <?php echo $u['email']; ?>"><?php echo $u['email']; ?></a></td>
                            <td><?php echo $u['nombre_rol']; ?></td>                            
                            <td><?php echo $u['nombre_idioma']; ?></td>   
                            <td><?php echo $u['last_date']; ?></td>                                                                             
                            <td>                              
                                <a href="/usuarios-sistema/view/<?php echo $u['id_usuario']; ?>" class="btn btn-default ml-1"><i class="fas fa-eye"></i></a>
                                <a href="/usuarios-sistema/edit/<?php echo $u['id_usuario']; ?>" class="btn btn-success ml-1"><i class="fas fa-edit"></i></a>
                                <a href="/usuarios-sistema/delete/<?php echo $u['id_usuario']; ?>" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a>
                            </td>

                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        Total de registros: <?php echo count($usuarios); ?>
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
