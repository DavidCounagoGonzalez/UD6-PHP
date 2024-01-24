<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Test cookies</h6>                                    
            </div>
            <div class="card-body">  
                <div class="alert alert-warning">
                    La clave PHPSESSID existe porque <b>hemos activado el manejo de sesiones en la aplicación haciendo un session_start() en el FrontController</b>.<br/>
                    Al activar el manejo de sesiones, se crea una cookie alfanumérica que es la que usa el servidor para identificarnos.<br/>
                    Las cookies se van a ver en la segunda ejecución del script ya que en la primera ejecución se crean después de recibir la petición del usuario. Las cookies se añaden en la cabecera de la petición del navegador web.
                    <div class="col-12 text-center mt-3">
                    <img src="assets/img/cookies-header.png"></div>
                </div>
                <?php var_dump($_COOKIE); ?>
                <table id="csvTable" class="table table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($_COOKIE as $key => $value){
                            ?>
                        <tr>
                            <td><?php echo $key; ?></td>
                            <td><?php echo htmlspecialchars($_COOKIE[$key]); //Mejor poner directamente htmlspecialchars($value) ?></td>
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
