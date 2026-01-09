<?php
require_once 'BaseModel.php';

class Proveedor extends BaseModel {
    protected static $table = "proveedor";
    protected static $primaryKey = "id_proveedor";

    public static function all() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM proveedor");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getInstance();
        $stmt = $db->prepare(
            "INSERT INTO proveedor (nombre, telefono)
             VALUES (:nombre, :telefono)"
        );

        return $stmt->execute([
            ':nombre'   => $data['nombre'],
            ':telefono' => $data['telefono']
        ]);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare(
            "DELETE FROM proveedor WHERE id_proveedor = :id"
        );
        return $stmt->execute([':id' => $id]);
    }
}
