<?php
class Database {
    private static $db = null;

    public static function getInstance() {
        if (!self::$db) {
            self::$db = new PDO(
                "mysql:host=sql.freedb.tech;dbname=freedb_Prueba12;charset=utf8",
                "freedb_Sayun",
                "v*K%M4sBNp8PKj3",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$db;
    }
}

