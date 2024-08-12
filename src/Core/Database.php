<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

class Database
{
    private PDO|null $pdo = null;

    public function connect(): PDO|null
    {
        if (!$this->pdo) {
            $this->pdo = new PDO('mysql:host=localhost;dbname=items_db', 'root', 'BekA$!o!03');

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }

        return $this->pdo;
    }

}