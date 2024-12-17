<?php
// Configuración de la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "publicidad";

// Conexión a la base de datos
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener imágenes de la categoría "Ocre"
$sql_ocre = "SELECT id, titulo, descripcion, archivo FROM imagenes WHERE categoria = 'ocre' ORDER BY id DESC";
$result_ocre = $conn->query($sql_ocre);
$imagenes_ocre = [];
if ($result_ocre->num_rows > 0) {
    while ($row = $result_ocre->fetch_assoc()) {
        $imagenes_ocre[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Productos - Ocre</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #000;
            color: #fff;
        }

        /* Header */
        header {
            background-color: #ff6600;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }
        header img {
            width: 70px;
            height: auto;
        }
        header h1 {
            margin: 0 auto;
            text-align: center;
            font-size: 2rem;
            letter-spacing: 2px;
        }

        /* Navbar */
        nav {
            display: flex;
            justify-content: center;
            background: #111;
            padding: 15px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
            font-weight: bold;
            transition: color 0.3s, border-bottom 0.3s;
            padding: 5px 0;
        }
        nav a:hover {
            color: #ff6600;
            border-bottom: 2px solid #ff6600;
        }

        /* Contenedor de productos */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .product-item {
            background: #1a1a1a;
            border: 2px solid #ff6600;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 102, 0, 0.5);
            overflow: hidden;
            width: 300px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 15px rgba(255, 102, 0, 0.8);
        }
        .product-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #ff6600;
        }
        .product-item h3 {
            margin: 10px 0;
            color: #ff6600;
        }
        button {
            background: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s;
        }
        button:hover {
            background: #cc5200;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background: #fff;
            color: #000;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            text-align: center;
            position: relative;
        }
        .modal-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #555;
            cursor: pointer;
        }

        /* Footer */
        footer {
            background: #111;
            color: #ff6600;
            text-align: center;
            padding: 10px;
            font-size: 1.2rem;
        }

        /* Botón flotante de WhatsApp */
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25d366;
            color: #fff;
            padding: 15px;
            border-radius: 50%;
            font-size: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
        }
        .whatsapp-float:hover {
            transform: scale(1.1);
        }
    </style>
    <script>
        function showModal(titulo, descripcion, archivo) {
            const modal = document.getElementById("modal");
            const modalContent = document.getElementById("modal-content");

            modalContent.innerHTML = `
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>${titulo}</h2>
                <img src="uploads/${archivo}" alt="${titulo}">
                <p>${descripcion}</p>
            `;
            modal.style.display = "flex";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }
    </script>
</head>
<body>

<header>
<button class="back-button" onclick="window.open('https://www.google.com', '_blank');" 
        style="position: absolute; right: 20px; top: 20px; background-color: black; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;">
    Salir
</button>

    <img src="5.png" alt="Logo de la empresa">
    <h1>Galería de Productos - Ocre</h1>
</header>

<nav>
    <a href="login.php">Inicio</a>
    <a href="#">Productos</a>
    <a href="https://wa.me/59171261231">Contacto</a>
</nav>

<div class="product-container">
    <?php foreach ($imagenes_ocre as $imagen): ?>
        <div class="product-item">
            <img src="uploads/<?php echo htmlspecialchars($imagen['archivo']); ?>" alt="<?php echo htmlspecialchars($imagen['titulo']); ?>">
            <h3><?php echo htmlspecialchars($imagen['titulo']); ?></h3>
            <button onclick="showModal('<?php echo addslashes(htmlspecialchars($imagen['titulo'])); ?>', '<?php echo addslashes(htmlspecialchars($imagen['descripcion'])); ?>', '<?php echo addslashes(htmlspecialchars($imagen['archivo'])); ?>')">
                Ver Producto
            </button>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal -->
<div id="modal" class="modal" onclick="closeModal()">
    <div id="modal-content" class="modal-content" onclick="event.stopPropagation();"></div>
</div>

<!-- Botón flotante de WhatsApp -->

<a href="https://wa.me/59171261231" target="_blank" class="whatsapp-float" title="Contáctanos por WhatsApp">&#x1F4F1;</a>

<!-- Footer -->
<footer>
    Empresa 2024
</footer>

</body>
</html>
