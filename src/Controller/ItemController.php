<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Model;
use PDOException;

class ItemController
{
    private Model $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function handleRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                $this->getItems();
                break;
            case 'POST':
                $this->createItem();
                break;
            case 'PUT':
                $this->updateItem();
                break;
            case 'DELETE':
                $this->deleteItem();
                break;
            default:
                $this->sendResponse(405, ['error' => 'Method Not Allowed']);
        }
    }

    private function getItems(): void
    {
        $sql = "SELECT * FROM `item`";
        $this->model->query($sql);
        $result = $this->model->records();

        $this->sendResponse(200, $result);
    }

    private function createItem(): void
    {
        $input = (array) json_decode(file_get_contents('php://input'), true);
        $sql = "INSERT INTO `item` (`name`, `color`, `type`, `status_id`) VALUES (:name, :color, :type, :status_id)";

        try {
            $this->model->query($sql, [
                ':name' => $input['name'] ?? null,
                ':color' => $input['color'] ?? null,
                ':type' => $input['type'] ?? null,
                ':status_id' => $input['status_id'] ?? null
            ]);
            $id = $this->model->primaryIndex();
            $this->sendResponse(201, ['message' => 'Item created', 'id' => $id]);
        } catch (PDOException $e) {
            $this->sendResponse(500, ['error' => $e->getMessage()]);
        }
    }

    private function updateItem(): void
    {
        $input = (array) json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        $sql = "UPDATE `item` SET `item`.`name` = :name, `item`.`color` = :color, `item`.`type` = :type WHERE `item`.`id` = :id";

        try {
            $this->model->query($sql, [
                ':name' => $input['name'] ?? null,
                ':color' => $input['color'] ?? null,
                ':type' => $input['type'] ?? null,
                ':id' => $id,
            ]);
            $this->sendResponse(200, ['message' => 'Item updated']);
        } catch (PDOException $e) {
            $this->sendResponse(500, ['error' => $e->getMessage()]);
        }
    }

    private function deleteItem(): void
    {
        $input = (array) json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        $sql = "DELETE FROM `item` WHERE `item`.`id` = :id";

        try {
            $this->model->query($sql, [':id' => $id]);
            $this->sendResponse(200, ['message' => 'Item deleted']);
        } catch (PDOException $e) {
            $this->sendResponse(500, ['error' => $e->getMessage()]);
        }
    }

    private function sendResponse(int $statusCode, array $data): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
