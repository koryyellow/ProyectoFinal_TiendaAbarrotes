<?php
require_once 'BaseModel.php';

class Producto extends BaseModel {
    protected static $table = "producto";
    protected static $primaryKey = "id_producto";

    public static function all() {
        $db = Database::getInstance();
        $stmt = $db->query(
            "SELECT 
                p.id_producto,
                p.nombre,
                p.precio,
                pr.nombre AS proveedor
             FROM producto p
             INNER JOIN proveedor pr 
                ON p.id_proveedor = pr.id_proveedor"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getInstance();
        $stmt = $db->prepare(
            "INSERT INTO producto (nombre, precio, id_proveedor)
             VALUES (:nombre, :precio, :id_proveedor)"
        );

        return $stmt->execute([
            ':nombre'       => $data['nombre'],
            ':precio'       => $data['precio'],
            ':id_proveedor' => $data['id_proveedor']
        ]);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare(
            "DELETE FROM producto WHERE id_producto = :id"
        );
        return $stmt->execute([':id' => $id]);
    }
}
