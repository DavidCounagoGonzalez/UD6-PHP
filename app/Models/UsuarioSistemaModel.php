<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class UsuarioSistemaModel extends \Com\Daw2\Core\BaseModel {
    
    private const SELECT_FROM = "SELECT us.*, ar.nombre_rol, ai.nombre_idioma FROM usuario_sistema us LEFT JOIN aux_rol ar ON ar.id_rol = us.id_rol LEFT JOIN aux_idiomas ai ON ai.id_idioma = us.id_idioma ORDER BY us.nombre";
    
    function getAll() : array{
        return $this->pdo->query(self::SELECT_FROM)->fetchAll();
    }
    
    function insertUsers(array $datos){
        $stmt = $this->pdo->prepare("INSERT INTO usuario_sistema (id_rol, email, pass, nombre, id_idioma) VALUES (:id_rol, :email, :pass, :nombre, :id_idioma)");
        $stmt->execute(['id_rol' => $datos['id_rol'], 'email' => $datos['email'], 'pass' => $datos['pass'], 'nombre' => $datos['nombre'], 'id_idioma' => $datos['idioma']]);
        return $this->pdo->lastInsertId();
    }
}