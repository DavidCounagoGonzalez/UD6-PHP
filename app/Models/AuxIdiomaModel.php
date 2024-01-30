<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class AuxIdiomaModel extends \Com\Daw2\Core\BaseModel{
    
    function getAll() : array{
        $stmt = $this->pdo->query('SELECT * FROM aux_idiomas ORDER BY nombre_idioma');
        return $stmt->fetchAll();
    }
    
    function loadIdioma(int $idIdioma) : ?array{
        $stmt = $this->pdo->prepare('SELECT * FROM aux_idiomas WHERE id_idioma = ?');
        $stmt->execute([$idIdioma]);
        if($row = $stmt->fetch()){
            return $row;
        }else{
            return null;
        }
    }
    
}