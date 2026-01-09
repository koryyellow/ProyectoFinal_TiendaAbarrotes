<?php
require_once __DIR__ . '/../config/database.php';

abstract class BaseModel {
    protected static $table;
    protected static $primaryKey;

    /* 🔹 Obtener todos los registros */
    public static function all() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM " . static::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 🔹 Buscar por ID */
    public static function find($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare(
            "SELECT * FROM " . static::$table . " WHERE " . static::$primaryKey . " = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* 🔹 Insertar seguro */
    public static function create($data) {
        $db = Database::getInstance();

        // Ignorar campos vacíos (como ID autoincremental)
        $data = array_filter($data, fn($v) => $v !== null && $v !== '');

        $columns = array_keys($data);
        $fields  = implode(', ', $columns);
        $params  = ':' . implode(', :', $columns);

        $sql = "INSERT INTO " . static::$table .
               " ($fields) VALUES ($params)";

        $stmt = $db->prepare($sql);

        // Crear array asociativo con placeholders
        $bindData = [];
        foreach ($columns as $col) {
            $bindData[":$col"] = $data[$col];
        }

        return $stmt->execute($bindData);
    }

    /* 🔹 Eliminar */
    public static function delete($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare(
            "DELETE FROM " . static::$table . " WHERE " . static::$primaryKey . " = ?"
        );
        return $stmt->execute([$id]);
    }
}

