<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

require_once 'models/Cliente.php';
require_once 'models/Empleado.php';
require_once 'models/Producto.php';
require_once 'models/Venta.php';
require_once 'models/DetalleVenta.php';
require_once 'models/PagoCredito.php';
require_once 'models/Proveedor.php';

$tablas = [
    "cliente"       => "Cliente",
    "empleado"      => "Empleado",
    "proveedor"     => "Proveedor",
    "producto"      => "Producto",
    "venta"         => "Venta",
    "detalle_venta" => "Detalle Venta",
    "pago_credito"  => "Pago Crédito"
];

$tabla = $_GET['tabla'] ?? 'cliente';

$modelos = [
    "cliente"       => Cliente::class,
    "empleado"      => Empleado::class,
    "proveedor"     => Proveedor::class,
    "producto"      => Producto::class,
    "venta"         => Venta::class,
    "detalle_venta" => DetalleVenta::class,
    "pago_credito"  => PagoCredito::class
];

$modeloActual = $modelos[$tabla];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modeloActual::create($_POST);
    header("Location: menu.php?tabla=$tabla");
    exit;
}

if (isset($_GET['eliminar'])) {
    $modeloActual::delete($_GET['eliminar']);
    header("Location: menu.php?tabla=$tabla");
    exit;
}

$datos       = $modeloActual::all();
$columnas    = array_keys($datos[0] ?? []);

$clientes    = Cliente::all();
$empleados   = Empleado::all();
$productos   = Producto::all();
$ventas      = Venta::all();
$proveedores = Proveedor::all();

// Datos para gráficas
$ventasPorMes = [];
foreach ($ventas as $v) {
    $mes = date('Y-m', strtotime($v['fecha']));
    $ventasPorMes[$mes] = ($ventasPorMes[$mes] ?? 0) + 1;
}
ksort($ventasPorMes);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard Ultra Pro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg,#667eea,#764ba2); color:#333; }
.sidebar { background:#fff; min-height:100vh; box-shadow:2px 0 15px rgba(0,0,0,0.1); }
.sidebar a { text-decoration:none; color:#333; display:block; padding:15px; border-radius:8px; margin-bottom:5px; }
.sidebar a.active { background:#667eea; color:#fff; font-weight:bold; }
.sidebar a:hover { background:#5a67d8; color:#fff; }
.main { padding:30px; flex-grow:1; }
.card-dashboard { border-radius:15px; padding:20px; color:#fff; box-shadow:0 8px 20px rgba(0,0,0,0.2); }
.card-dashboard h5 { font-weight:700; }
.table-responsive { background:white; border-radius:10px; padding:15px; box-shadow:0 5px 15px rgba(0,0,0,0.15); }
.btn-floating { position:fixed; bottom:30px; right:30px; border-radius:50%; width:60px; height:60px; font-size:28px; display:flex; align-items:center; justify-content:center; box-shadow:0 5px 15px rgba(0,0,0,0.3); }
.chart-card { background:white; border-radius:15px; padding:20px; box-shadow:0 8px 20px rgba(0,0,0,0.2); margin-bottom:30px; }
</style>
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h2 class="mb-4">🛒 Admin Panel</h2>
        <?php foreach ($tablas as $key => $nombre): ?>
            <a class="<?= $tabla === $key ? 'active' : '' ?>" href="?tabla=<?= $key ?>"><?= $nombre ?></a>
        <?php endforeach; ?>
        <a href="?logout=1" class="mt-4 btn btn-danger w-100">Cerrar Sesión</a>
    </div>

    <!-- Main content -->
    <div class="main">

        <!-- Dashboard cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-2 col-6"><div class="card-dashboard" style="background:#4e73df;"><h5><i class="bi bi-people-fill"></i> Clientes</h5><p class="display-6 fw-bold"><?= count($clientes) ?></p></div></div>
            <div class="col-md-2 col-6"><div class="card-dashboard" style="background:#1cc88a;"><h5><i class="bi bi-person-badge-fill"></i> Empleados</h5><p class="display-6 fw-bold"><?= count($empleados) ?></p></div></div>
            <div class="col-md-2 col-6"><div class="card-dashboard" style="background:#36b9cc;"><h5><i class="bi bi-truck"></i> Proveedores</h5><p class="display-6 fw-bold"><?= count($proveedores) ?></p></div></div>
            <div class="col-md-2 col-6"><div class="card-dashboard" style="background:#f6c23e;"><h5><i class="bi bi-box-seam"></i> Productos</h5><p class="display-6 fw-bold"><?= count($productos) ?></p></div></div>
            <div class="col-md-2 col-6"><div class="card-dashboard" style="background:#e74a3b;"><h5><i class="bi bi-cart-fill"></i> Ventas</h5><p class="display-6 fw-bold"><?= count($ventas) ?></p></div></div>
        </div>

        <!-- Formulario -->
        <div class="card mb-5 shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-3">Agregar a <?= ucfirst($tabla) ?></h4>
                <form method="post">

                    <?php if ($tabla === 'producto'): ?>
                        <label class="form-label">Nombre del producto</label>
                        <input class="form-control mb-3" name="nombre" required>

                        <label class="form-label">Precio</label>
                        <input class="form-control mb-3" type="number" step="0.01" name="precio" required>

                        <label class="form-label">Proveedor</label>
                        <select class="form-select mb-3" name="id_proveedor" required>
                            <?php foreach ($proveedores as $p): ?>
                                <option value="<?= $p['id_proveedor'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>

                    <?php elseif ($tabla === 'proveedor'): ?>
                        <label class="form-label">Nombre del proveedor</label>
                        <input class="form-control mb-3" name="nombre" required>
                        <label class="form-label">Teléfono</label>
                        <input class="form-control mb-3" name="telefono">
                        <label class="form-label">Email</label>
                        <input class="form-control mb-3" name="email">

                    <?php elseif ($tabla === 'cliente'): ?>
                        <?php foreach ($columnas as $col):
                            if (strpos($col,'id_')===0) continue; ?>
                            <label class="form-label"><?= $col ?></label>
                            <input class="form-control mb-3" name="<?= $col ?>" required>
                        <?php endforeach; ?>

                    <?php elseif ($tabla === 'empleado'): ?>
                        <?php foreach ($columnas as $col):
                            if (strpos($col,'id_')===0) continue; ?>
                            <label class="form-label"><?= $col ?></label>
                            <input class="form-control mb-3" name="<?= $col ?>" required>
                        <?php endforeach; ?>

                    <?php elseif ($tabla === 'venta'): ?>
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control mb-3" name="fecha" required>
                        <label class="form-label">Cliente</label>
                        <select class="form-select mb-3" name="id_cliente">
                            <?php foreach ($clientes as $c): ?>
                                <option value="<?= $c['id_cliente'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="form-label">Empleado</label>
                        <select class="form-select mb-3" name="id_empleado">
                            <?php foreach ($empleados as $e): ?>
                                <option value="<?= $e['id_empleado'] ?>"><?= htmlspecialchars($e['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="form-label">Forma de pago</label>
                        <input class="form-control mb-3" name="forma_pago" required>

                    <?php elseif ($tabla === 'detalle_venta'): ?>
                        <label class="form-label">Venta</label>
                        <select class="form-select mb-3" name="id_venta">
                            <?php foreach ($ventas as $v): ?>
                                <option value="<?= $v['id_venta'] ?>">Venta #<?= $v['id_venta'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="form-label">Producto</label>
                        <select class="form-select mb-3" name="id_producto">
                            <?php foreach ($productos as $p): ?>
                                <option value="<?= $p['id_producto'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control mb-3" name="cantidad" required>

                    <?php elseif ($tabla === 'pago_credito'): ?>
                        <label class="form-label">Venta</label>
                        <select class="form-select mb-3" name="id_venta">
                            <?php foreach ($ventas as $v): ?>
                                <option value="<?= $v['id_venta'] ?>">Venta #<?= $v['id_venta'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="form-label">Fecha de pago</label>
                        <input type="date" class="form-control mb-3" name="fecha_pago" required>
                        <label class="form-label">Monto</label>
                        <input type="number" step="0.01" class="form-control mb-3" name="monto" required>
                        <label class="form-label">Saldo restante</label>
                        <input type="number" step="0.01" class="form-control mb-3" name="saldo_restante" required>
                    <?php endif; ?>

                    <button class="btn btn-success w-100" type="submit">Agregar</button>
                </form>
            </div>
        </div>

        <!-- Tabla de datos -->
        <div class="table-responsive mb-5 shadow-sm">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <?php foreach ($columnas as $col): ?>
                            <th><?= $col ?></th>
                        <?php endforeach; ?>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $fila): ?>
                    <tr>
                        <?php foreach ($columnas as $col): ?>
                            <td>
                                <?php
                                if ($tabla==='producto' && $col==='id_proveedor') {
                                    $prov = array_filter($proveedores, fn($p) => $p['id_proveedor']==$fila[$col]);
                                    echo htmlspecialchars($prov ? array_values($prov)[0]['nombre'] : 'Desconocido');
                                } else {
                                    echo htmlspecialchars($fila[$col]);
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <a class="btn btn-danger btn-sm" href="?tabla=<?= $tabla ?>&eliminar=<?= $fila[$columnas[0]] ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Gráficas -->
        <div class="chart-card">
            <h4 class="mb-4">📊 Ventas por mes</h4>
            <canvas id="ventasChart"></canvas>
        </div>

        <!-- Botón flotante -->
        <a href="menu.php?tabla=<?= $tabla ?>" class="btn btn-primary btn-floating">
            <i class="bi bi-arrow-clockwise"></i>
        </a>

    </div>
</div>

<script>
const ctx = document.getElementById('ventasChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_keys($ventasPorMes)) ?>,
        datasets: [{
            label: 'Ventas por mes',
            data: <?= json_encode(array_values($ventasPorMes)) ?>,
            backgroundColor: 'rgba(78, 115, 223, 0.7)',
            borderColor: 'rgba(78, 115, 223, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive:true,
        plugins: { legend:{ display:true } },
        scales: { y: { beginAtZero:true, stepSize:1 } }
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

