<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Test session</h6>                                    
            </div>
            <div class="card-body">  
                <?php var_dump($_SESSION); ?>
                <table id="csvTable" class="table table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($_SESSION as $key => $value){
                            ?>
                        <tr>
                            <td><?php echo $key; ?></td>
                            <td><?php echo htmlspecialchars($_SESSION[$key]); //Mejor poner directamente htmlspecialchars($value) ?></td>
                        </tr>
                            <?php
                        }                    
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>
<!--<script src="./vendor/jquery/jquery.min.js"></script>-->
