<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* 🔌 CONEXIÓN PDO PERSISTENTE */
try {
    $db = new PDO(
        "mysql:host=sql.freedb.tech;dbname=freedb_Prueba12;charset=utf8",
        "freedb_Sayun",
        "v*K%M4sBNp8PKj3",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$error = "";

// 🔹 REDIRECCIÓN SI YA ESTÁ LOGUEADO
if (isset($_SESSION['usuario'])) {
    header("Location: menu.php");
    exit;
}

// 🔐 PROCESO DE LOGIN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario  = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Consulta segura usando PDO
    $stmt = $db->prepare("SELECT * FROM login WHERE username = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificación (temporal, hasta que uses password_hash)
    if ($user && $password === $user['password']) {
        $_SESSION['usuario'] = $usuario;
        header("Location: menu.php");
        exit;
    } else {
        $error = "❌ Usuario o contraseña incorrectos";
    }
}

// 🔑 LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg,#4e73df,#1cc88a);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
}
.card {
    background: white;
    width: 350px;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,.2);
}
h2 {
    text-align: center;
    margin-bottom: 20px;
}
input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}
button {
    width: 100%;
    padding: 10px;
    background: #4e73df;
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 6px;
    cursor: pointer;
}
button:hover {
    background: #2e59d9;
}
.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}
</style>
</head>
<body>

<div class="card">
    <h2>🔐 Iniciar Sesión</h2>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="login">Entrar</button>
    </form>
</div>

</body>
</html>

