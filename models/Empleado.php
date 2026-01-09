<?php
require_once 'BaseModel.php';

class Empleado extends BaseModel {
    protected static $table = "empleado";
    protected static $primaryKey = "id_empleado";
}
