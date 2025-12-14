<?php
// debug_login.php
include("conexion.php"); // tu archivo real
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $pass = $_POST['password'];

    // Extraer fila del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        echo "Usuario NO encontrado.<br>";
    } else {
        $row = $res->fetch_assoc();
        echo "<b>Valor en DB (column password):</b> " . htmlspecialchars($row['password']) . "<br>";
        echo "<b>MD5(post):</b> " . md5($pass) . "<br>";
        echo "<b>password_hash(post) (no está en DB):</b> " . password_hash($pass, PASSWORD_DEFAULT) . "<br>";

        // Comparaciones comunes:
        echo "<hr>";
        echo "Comparaciones:<br>";
        echo "MD5(post) === DB ? " . (md5($pass) === $row['password'] ? '<b style=\"color:green\">SI</b>' : '<b style=\"color:red\">NO</b>') . "<br>";
        echo "password_verify(post, DB) ? " . (password_verify($pass, $row['password']) ? '<b style=\"color:green\">SI</b>' : '<b style=\"color:red\">NO</b>') . "<br>";
    }
    $stmt->close();
    $conn->close();
    exit;
}
?>
<!doctype html>
<html><body>
<h3>Debug login</h3>
<form method="POST">
Usuario: <input name="usuario"><br>
Pass: <input name="password" type="password"><br>
<button>Probar</button>
</form>
</body></html>