<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class CategoriaModel extends \Com\Daw2\Core\BaseModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM categoria');
        $res = [];
        foreach($stmt->fetchAll() as $c){
            $res[] = $this->rowAddPadre($c);
        }
        return $res;
    }
    
    function getAllMinus(int $id): array {
        $stmt = $this->pdo->prepare('SELECT * FROM categoria WHERE id_categoria != :id');
        $stmt->execute(['id' => $id]);
        $res = [];
        foreach($stmt->fetchAll() as $c){
            $res[] = $this->rowAddPadre($c);
        }
        return $res;
    }
    
    function size() : int {
        $stmt = $this->pdo->query('SELECT * FROM categoria');
        return count($stmt->fetchAll());
    }

    function getNombreCategoria(string $id): array {
        $stmt = $this->pdo->prepare('SELECT nombre_categoria FROM categoria WHERE id_categoria=?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function delete(string $id): int {
        try { #if there are products enroled to the provider returns 0
            $stmt = $this->pdo->prepare('SELECT * FROM producto WHERE id_categoria=?');
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
                return 0;
            } else { #if everything was ok return 1
                $stmt = $this->pdo->prepare('DELETE FROM categoria WHERE id_categoria=?');
                $stmt->execute([$id]);
                if ($stmt->rowCount() == 1) {
                    return 1;
                }
            }
        } catch (PDOException $exception) { #if an exception happens return a -1
            return -1;
        }
    }

    function add(int $idCategoria, string $nombre, ?int $idPadre): bool {                           
        $stmt = $this->pdo->prepare('INSERT INTO categoria(id_categoria, nombre_categoria, id_padre) values (?,?,?)');
        return $stmt->execute([
            $idCategoria, $nombre, $idPadre]
        );
    }

    function showEdit(string $id): array {
        $stmt = $this->pdo->prepare('SELECT * FROM categoria WHERE id_categoria=?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function edit(int $id, string $nombre, ?int $id_padre): bool {
        try {            
            $stmt = $this->pdo->prepare('UPDATE categoria SET nombre_categoria=?, id_padre=? WHERE id_categoria=?');
            return $stmt->execute([$nombre, $id_padre, $id]);
        } catch (PDOException $ex) {
            echo "cant update for some reason: " . $ex->getMessage();
            return false;
        }
    }
    
    public function loadCategoria(int $id) : array{
        $stmt = $this->pdo->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
        $stmt->execute([$id]);
        if($row = $stmt->fetch()){
           return $this->rowAddPadre($row);
        }       
        return null;
    }
    
    /*
     * Con arrays
     */
    public function getAllCategorias() : array{
        $_res = array();
        $stmt = $this->pdo->prepare("SELECT * FROM categoria WHERE id_padre is NULL ORDER BY nombre_categoria");
        $stmt->execute();
        $_categorias = $stmt->fetchAll();
        foreach($_categorias as $c){
            //Si tiene padre lo añadimos a la posición padre del array.
            $categoria = $this->rowAddPadre($c);
            $_res[] = $categoria;            
            $_res = array_merge($_res, $this->getAllCategoriasHijas($c['id_categoria']));            
        }
        return $_res;
    }
    private function getAllCategoriasHijas(int $id_padre) : array{
        $_res = array();
        $stmt = $this->pdo->prepare("SELECT * FROM categoria WHERE id_padre = ? ORDER BY nombre_categoria");
        $stmt->execute([$id_padre]);
        $_cats = $stmt->fetchAll();
        foreach($_cats as $c){
            //Si tiene padre lo añadimos a la posición padre del array.
            $categoria = $this->rowAddPadre($c);
            $_res[] = $categoria;
            $_res = array_merge($_res, $this->getAllCategoriasHijas($c['id_categoria']));
        }
        return $_res;
    }
    
    private function rowAddPadre(?array $row) : array{
        if (is_null($row['id_padre'])) {            
            $row['padre'] = null;
        } else {
            $row['padre'] = $this->loadCategoria($row['id_padre']);
        }
        //Calculamos full_name
        $fullName = $row['nombre_categoria'];
        $padre = $row['padre'];
        while(!is_null($padre)){
            $fullName = $padre['nombre_categoria'] . ' > ' . $fullName;
            $padre = $padre['padre'];
        }   
        $row['fullName'] = htmlspecialchars($fullName);
        return $row;
    }
       
    /**
     * Inserta en la posición padre del array los datos del padre 
     * @param array $row
     * @return array
     */
    private function categoriaWithParents(array $row) : array{
        if (is_null($row['id_padre'])) {            
            $row['padre'] = null;
        } else {
            $row['padre'] = $this->loadCategoria($row['id_padre']);
        }
        unset($row['id_padre']);
        return $row;
    }

}
