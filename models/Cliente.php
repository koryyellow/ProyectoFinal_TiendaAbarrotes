<?php
require_once 'BaseModel.php';

class Cliente extends BaseModel {
    protected static $table = "cliente";
    protected static $primaryKey = "id_cliente";
}
