<div class="row">        
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Alta histórico 2020</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!--<form action="./?sec=formulario" method="post">                   -->
                <form method="post" action="/csv/new-2020">                      
                    <div class="mb-3">
                        <label for="municipio">Municipio:</label>
                        <input class="form-control" id="municipio" type="text" name="municipio" placeholder="Municipio" value="<?php echo isset($input['municipio']) ? $input['municipio'] : ''; ?>">                        
                        <p class="text-danger"><?php echo isset($errores['municipio']) ? $errores['municipio'] : ''; ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="poblacion">Población:</label>
                        <input class="form-control" id="poblacion" type="text" name="poblacion" placeholder="Población" value="<?php echo isset($input['poblacion']) ? $input['poblacion'] : ''; ?>">                        
                        <p class="text-danger"><?php echo isset($errores['poblacion']) ? $errores['poblacion'] : ''; ?></p>
                    </div>                        
                    <div class="mb-3">
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>
