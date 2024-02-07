<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class UsuarioSistemaModel extends \Com\Daw2\Core\BaseModel {

    private const SELECT_FROM = "SELECT us.*, ar.nombre_rol, ai.nombre_idioma FROM usuario_sistema us LEFT JOIN aux_rol ar ON ar.id_rol = us.id_rol LEFT JOIN aux_idiomas ai ON ai.id_idioma = us.id_idioma ORDER BY us.nombre";

    function getAll(): array {
        return $this->pdo->query(self::SELECT_FROM)->fetchAll();
    }

    function insertUsers(array $datos) {
        $stmt = $this->pdo->prepare("INSERT INTO usuario_sistema (id_rol, email, pass, nombre, id_idioma) VALUES (:id_rol, :email, :pass, :nombre, :id_idioma)");
        if ($stmt->execute(['id_rol' => $datos['id_rol'], 'email' => $datos['email'], 'pass' => password_hash($datos['pass'], PASSWORD_DEFAULT), 'nombre' => $datos['nombre'], 'id_idioma' => $datos['id_idioma']])) {
            return $this->pdo->lastInsertId();
        } else {
            return 0;
        }
    }

    function updateUsers(array $datos, int $id) {
        $stmt = $this->pdo->prepare("UPDATE usuario_sistema SET id_rol=:id_rol, email=:email, nombre=:nombre, id_idioma=:id_idioma WHERE id_usuario = :id_usuario");
        $vars = [
            'id_rol' => $datos['id_rol'],
            'email' => $datos['email'],
            'nombre' => $datos['nombre'],
            'id_idioma' => $datos['id_idioma'],
            'id_usuario' => $id
        ];
        return $stmt->execute($vars);
    }

    function updatePass(array $datos, int $id) {
        $stmt = $this->pdo->prepare("UPDATE usuario_sistema SET pass=:pass WHERE id_usuario=:id_usuario");
        $vars = [
            'pass' => password_hash($datos['pass'], PASSWORD_DEFAULT),
            'id_usuario' => $id
        ];
        return $stmt->execute($vars);
    }

    function loadByEmail(string $email): ?array {
        $query = "SELECT * FROM usuario_sistema WHERE email = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);
        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    function loadByUser(int $id): ?array {
        $query = "SELECT * FROM usuario_sistema WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    function getEditEmail(array $data, int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario_sistema us WHERE us.email =? AND us.id_usuario !=?");
        $stmt->execute([$data['email'], $id]);

        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    function deleteUsuarioSistema(int $id): bool {
        if ($id !== $_SESSION['usuario']['id_usuario']) {
            $query = "DELETE FROM usuario_sistema WHERE id_usuario = ?";
            $stmt = $this->pdo->prepare($query);
            if ($stmt->execute([$id]) && $stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function baja(int $id, int $estado): bool {
        if ($id !== $_SESSION['usuario']['id_usuario']) {
            $query = "UPDATE usuario_sistema SET baja=? WHERE id_usuario = ?";
            $stmt = $this->pdo->prepare($query);
            if ($stmt->execute([$estado, $id]) && $stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function ultimoInicio(int $id): bool {
        $query = "UPDATE usuario_sistema SET last_date=NOW() WHERE id_usuario=?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id]);
    }
}
