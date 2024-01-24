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
    <?php
    if(isset($_GET['insertado']) && !empty($_GET['insertado'])){
        ?>
    <div class="col-12">
        <div class="alert alert-success"><p>Se ha insertado correctamente el municipio <?php echo htmlspecialchars(urldecode($_GET['insertado'])); ?></p></div>
    </div>
    <?php
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos del CSV</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php 
                if(count($datos) > 0){                                    
                ?>
                <!--<form action="./?sec=formulario" method="post">                   -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th>Municipio</th>
                            <th>Población</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i = 1; $i < count($datos); $i++){
                            $fila = $datos[$i];
                            echo '<tr>';
                            ?>
                            <td><?php echo $fila[0];?></td>
                            <td><?php echo $fila[3];?></td>
                        <?php
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><?php echo $masPoblacion[0]; ?></td>                            
                            <td><?php echo $masPoblacion[3]; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $menosPoblacion[0]; ?></td>                            
                            <td><?php echo $menosPoblacion[3]; ?></td>
                        </tr>
                    </tfoot>
                </table>
                <?php
                }
                else{
                ?>
                <p class="text-danger">No hay datos en el CSV.</p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>                        
</div>
