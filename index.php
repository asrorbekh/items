<?php

declare(strict_types=1);

use App\Controller\ItemController;

require 'vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

ini_set('display_errors', 'On');

$controller = new ItemController();
$controller->handleRequest();


//$model = new Model();
//
//// crud
//
//// insert = create
//
//$sql = "INSERT INTO `item` (`name`, `color`, `type`) VALUES (:name, :color, :type)";
//
//$params = array(
//    ':name' => 'Apple',
//    ':color' => 'red',
//    ':type' => 'fruit'
//);
//
//$model->query($sql, $params);
//
//$result = $model->primaryIndex();
//
//if ($result) {
//    if (is_numeric($result)) {
//        // update item
//
//        $id = $result;
//
//        $sql = "UPDATE item SET item.status_id = :status_id, item.updated = :updated WHERE item.id = :id";
//
//        $params = array(
//            ':id' => $id,
//            ':status_id' => 1,
//            ':updated' => date('Y-m-d H:i:s')
//        );
//
//        $model->query($sql, $params);
//
//        $result = $model->error ?? true;
//
//        if ($result) {
//            if (is_bool($result)) {
//                // select items
//
//                $sql = "SELECT item.* FROM item WHERE item.status_id = :status_id";
//
//                $params = array(
//                    ':status_id' => 1
//                );
//
//                $model->query($sql, $params);
//
//                $result = $model->records();
//
//                if ($result) {
//                    if (is_array($result)) {
//                        // select item
//
//                        $sql = "SELECT item.* FROM item WHERE item.id = :id LIMIT 1";
//
//                        $params = array(
//                            ':id' => $id
//                        );
//
//                        $model->query($sql, $params);
//
//                        $result = $model->record();
//
//
//                        if ($result) {
//                            if (is_object($result)) {
//                                // delete item
//
//                                $sql = "DELETE FROM item WHERE item.id = :id";
//
//                                $params = array(
//                                    ':id' => $id
//                                );
//
//                                $model->query($sql, $params);
//
//                                $result = $model->error ?? true;
//
//                                if ($result) {
//                                    if (is_bool($result)) {
//                                        print_r($result);
//                                    } else {
//                                        print_r($result);
//                                    }
//                                }
//                            }
//                        } else {
//                            print_r($result);
//                        }
//                    }
//                } else {
//                    print_r($result);
//                }
//            } else {
//                print_r($result);
//            }
//        }
//    } else {
//        print_r($result);
//    }
//}