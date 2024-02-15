<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class ProductoModel extends \Com\Daw2\Core\BaseModel {
    
    private const FROM = "FROM producto LEFT JOIN categoria ON categoria.id_categoria = producto.id_categoria LEFT JOIN proveedor ON proveedor.cif = producto.proveedor";
    private const SELECT_FROM = "SELECT producto.*, categoria.nombre_categoria, proveedor.codigo AS codigo_proveedor, (coste * margen * (1 + iva/100 )) as pvp ". self::FROM;
    
    function getAll() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM);
        return $stmt->fetchAll();
    }
    
    public function loadProducto(string $id) : ?array{
        $stmt = $this->pdo->prepare("SELECT * FROM producto WHERE codigo = ?");
        $stmt->execute([$id]);
        if($row = $stmt->fetch()){
           return $row;
        } 
        else{
            return null;
        }
    }
    
    public function size() : int{
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM producto");        
        return $stmt->fetchColumn();
    }
    
    public function insertProducto(array $data) : bool{
        $sql = "INSERT INTO producto (codigo, nombre, descripcion, proveedor, coste, margen, stock, iva, id_categoria) VALUES(:codigo, :nombre, :descripcion, :proveedor, :coste, :margen, :stock, :iva, :id_categoria)";
        $stmt = $this->pdo->prepare($sql);
        unset($data['enviar']);
        if($stmt->execute($data)){
            return $stmt->rowCount() === 1;
        }
        else{
            return false;
        }

    }
    
    public function updateProducto(array $data) : bool{
        $sql = "UPDATE producto SET nombre=:nombre, descripcion=:descripcion, proveedor=:proveedor, coste=:coste, margen=:margen, stock=:stock, iva=:iva, id_categoria=:id_categoria WHERE codigo=:codigo";
        $stmt = $this->pdo->prepare($sql);
        unset($data['enviar']);
        if($stmt->execute($data)){
            return $stmt->rowCount() <= 1;
        }
        else{
            return false;
        }
    }
    
    public function deleteProducto(string $id) : bool{
        $stmt = $this->pdo->prepare("DELETE FROM producto WHERE codigo = ?");       
        if($stmt->execute([$id]) && $stmt->rowCount() == 1){
           return true;
        } 
        else{
            return false;
        }
    }
    
    public function getByFiltros($filtros): array {
        $consulta = self::SELECT_FROM;
        
        $informacion = $this->filtrado($filtros);
        
        if(!empty($informacion['param'])){
            $consulta .= " WHERE ".implode(" AND ", $informacion['condiciones']);
            $stmt = $this->pdo->prepare($consulta);
            $stmt->execute($informacion['param']);
            return $stmt->fetchAll();
        }else{
            $stmt = $this->pdo->query($consulta);
            return $stmt->fetchAll();
        }
    }


    private function filtrado($filtros): array {
        $condiciones = [];
        $param = [];;
        
        if(!empty($filtros['codigo'])){
            $condiciones[] = "producto.codigo LIKE :codigo";
            $param['codigo'] = '%' .$filtros["codigo"]. '%';
        }
        
        if(!empty($filtros['nombre'])){
            $condiciones[] = 'producto.nombre LIKE :nombre';
            $param['nombre'] = '%' .$filtros["nombre"]. '%';
        }
        
        if(!empty($filtros['id_categoria']) && filter_var($filtros['id_categoria'], FILTER_VALIDATE_INT)){
            $condiciones[] = 'producto.id_categoria = :id_categoria';
            $param['id_categoria'] = $filtros['id_categoria'];
        }
        
        if(!empty($filtros['min_pvp']) && filter_var($filtros['min_pvp'], FILTER_VALIDATE_FLOAT)){
            $condiciones[] = '(coste * margen * (1 + iva/100 )) >= :min_pvp';
            $param['min_pvp'] = $filtros['min_pvp'];
        }
        
        if(!empty($filtros['max_pvp']) && filter_var($filtros['max_pvp'], FILTER_VALIDATE_FLOAT)){
            $condiciones[] = '(coste * margen * (1 + iva/100 )) <= :max_pvp';
            $param['max_pvp'] = $filtros['max_pvp'];
        }
        
        $informacion = array(
            "condiciones" => $condiciones,
            "param" => $param
        );
        
        return $informacion;
        
    }
}