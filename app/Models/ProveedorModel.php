<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class ProveedorModel extends \Com\Daw2\Core\BaseModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM proveedor ORDER BY cif, nombre');
        return $stmt->fetchAll();
    }
    
    function size() : int {
        $stmt = $this->pdo->query('SELECT * FROM proveedor');
        return count($stmt->fetchAll());
    }

    function delete(string $cif): int {
        try { #if there are products enroled to the provider returns 0
            $stmt = $this->pdo->prepare('SELECT * FROM producto WHERE proveedor=?');
            $stmt->execute([$cif]);
            if ($stmt->rowCount() > 0) {
                return 0;
            } else { #if everything was ok return 1
                try {
                    $this->pdo->beginTransaction();
                    $stmt = $this->pdo->prepare('DELETE FROM proveedor WHERE cif=?');
                    $stmt->execute([$cif]);
                    if ($stmt->rowCount() == 1) {
                        $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
                        $stmtLog->execute([
                            'delete', 'proveedor', 'Borrado el proveedor con cif=' . $cif . '.'
                        ]);
                        $this->pdo->commit();
                        return 1;
                    }
                } catch (Exception $ex) {
                    $this->pdo->rollback();
                    echo $ex->getMessage();
                    return -1;
                }
            }
        } catch (PDOException $exception) { #if an exception happens return a -1
            return -1;
        }
    }

    function add(string $cif, string $codigo, string $nombre, string $direccion, string $website, string $pais, string $email, string $telefono): bool {
        try {
            $size = count($this->getAll());
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare('INSERT INTO proveedor(cif,codigo,nombre,direccion,website,pais,email,telefono) values (?,?,?,?,?,?,?,?)');
            $stmt->execute([
                $cif, $codigo, $nombre, $direccion, $website, $pais, $email, $telefono]
            );
            $new_size = count($this->getAll());

            if (($size + 1) == $new_size) {
                $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
                $stmtLog->execute([
                    'insert', 'proveedor', 'Añadido un nuevo elemento a la tabla de proveedores con los datos: cif =' .
                    $cif . ' codigo=' . $codigo . ' nombre=' . $nombre . ' direccion=' . $direccion . ' website=' . $website . ' pais=' . $pais . ' email=' . $email .
                    ' telefono=' . $telefono . '.'
                ]);
                $this->pdo->commit();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->pdo->rollback();
            echo $e->getMessage();
            return false;
        }
    }

    function loadProveedor(string $cif): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM proveedor WHERE cif=?');
        $stmt->execute([$cif]);
        if($row = $stmt->fetch()){
           return $row;
        }   
        else{
            return null;
        }
    }

    function edit(string $cif, string $codigo, string $nombre, string $direccion, string $website, string $pais, string $email, string $telefono): bool {
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare('UPDATE proveedor SET codigo=?, nombre=?, direccion=?, website=?, pais=?, email=?, telefono=? WHERE cif=?');
            $stmt->execute([$codigo, $nombre, $direccion, $website, $pais, $email, $telefono, $cif]);
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute([
                'update', 'proveedor', 'Editado el proveedor con cif=' . $cif . ' a los siguientes valores: codigo=' . $codigo .
                ' nombre=' . $nombre . ' direccion=' . $direccion . ' website=' . $website . ' pais=' . $pais . ' email=' .
                $email . ' telefono=' . $telefono . '.'
            ]);
            $this->pdo->commit();
            return true;
        } catch (Exception $ex) {
            $this->pdo->rollback();
            echo "cant update for some reason: " . $ex->getMessage();
            return false;
        }
    }

}
