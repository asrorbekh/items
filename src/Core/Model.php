<?php

declare(strict_types=1);

namespace App\Core;

use Error;

class Model
{
    private Database|null $database = null;
    private \PDOStatement|null $pdoStatement = null;
    public object $error;

    public function __construct()
    {
        if ($this->database === null) {
            $this->database = new Database();
        }

    }

    public function query(string $query, array $params = []): void
    {
        try {
            if ($this->database) {
                $this->pdoStatement = $this->database->connect()->prepare($query);

                $this->pdoStatement->execute($params);
            }
        } catch (\PDOException $e) {
            $this->error = new \stdClass();
            $this->error->code = $e->getCode();
            $this->error->message = $e->getMessage();
            $this->error->file = $e->getFile();
            $this->error->line = $e->getLine();
        }
    }

    public function record(): mixed
    {
        if (isset($this->error) && $this->error) {
            return $this->error;
        }

        return $this->pdoStatement?->fetch();
    }

    public function records(): array|bool|null|object
    {
        if (isset($this->error) && $this->error) {
            return $this->error;
        }

        return $this->pdoStatement?->fetchAll();
    }

    public function primaryIndex(): string|bool|null|object
    {
        if (isset($this->error) && $this->error) {
            return $this->error;
        }

        return $this->database?->connect()->lastInsertId();
    }
}