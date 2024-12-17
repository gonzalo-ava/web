<?php
// Usuario y contraseña por defecto
$usuario_default = "admin";
$contraseña_default = "1234";

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Verificar si las credenciales son correctas
    if ($usuario === $usuario_default && $contraseña === $contraseña_default) {
        // Redirigir a admin.php si las credenciales son correctas
        header("Location: admin.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(to bottom, #000000, #ff6600); /* Degradado de negro a naranja */
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        flex-direction: column; /* Alinea los elementos en columna */
    }

    .back-button {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: #ff6600; /* Color naranja */
        color: #000000;
        border: none;
        padding: 4px 8px; /* Más pequeño */
        border-radius: 4px; /* Esquinas más redondeadas */
        font-weight: bold;
        cursor: pointer;
        font-size: 0.8rem; /* Tamaño de fuente más pequeño */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        transition: background-color 0.3s ease;
        width: auto; /* Anchura automática para ajustarse al texto */
    }

    .back-button:hover {
        background-color: #e65c00; /* Naranja más oscuro al pasar el mouse */
    }

    .login-container {
        background: rgba(0, 0, 0, 0.9); /* Fondo más oscuro y opaco */
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(255, 102, 0, 0.5); /* Sombra con tono naranja */
        width: 320px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #ff6600; /* Naranja vibrante */
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 12px 0;
        border-radius: 5px;
        border: 1px solid #ff6600; /* Borde naranja */
        background: #222222; /* Fondo negro oscuro */
        color: white;
        box-shadow: inset 0 0 5px rgba(255, 102, 0, 0.5); /* Sombra interna naranja */
    }

    input:focus {
        outline: none;
        border-color: #ff4500; /* Naranja más intenso */
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #ff6600; /* Naranja principal */
        color: #000000; /* Texto en negro */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        text-transform: uppercase;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        transition: all 0.3s ease;
    }

    button:hover {
        background-color: #e65c00; /* Naranja más oscuro al pasar el mouse */
        transform: translateY(-2px); /* Efecto de elevación */
    }

    .error {
        color: #ff4500; /* Rojo-naranja para mensajes de error */
        text-align: center;
        margin-top: 10px;
        font-size: 0.9rem;
    }
</style>

</head>
<body>
<button class="back-button" onclick="window.location.href='index.php';" 
        style="position: absolute; left: 20px; top: 20px; background-color: #FF6A00; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;">
    Volver
</button>


    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form action="login.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required><br>
            <input type="password" name="contraseña" placeholder="Contraseña" required><br>
            <button type="submit">Iniciar sesión</button>
        </form>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
