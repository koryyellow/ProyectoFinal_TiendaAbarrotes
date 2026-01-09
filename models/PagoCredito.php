<?php
require_once 'BaseModel.php';

class PagoCredito extends BaseModel {
    protected static $table = "pago_credito";
    protected static $primaryKey = "id_pago";
}
