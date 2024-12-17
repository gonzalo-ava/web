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

// Procesar la subida de la imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'upload') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];  // Siempre será 'ocre' ahora
    
    // Manejo del archivo
    $archivo = $_FILES['archivo'];
    $archivo_nombre = basename($archivo['name']);
    $archivo_ruta = "uploads/" . $archivo_nombre;

    // Subir el archivo
    if (move_uploaded_file($archivo['tmp_name'], $archivo_ruta)) {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO imagenes (titulo, descripcion, archivo, categoria) 
                VALUES ('$titulo', '$descripcion', '$archivo_nombre', '$categoria')";
        if ($conn->query($sql) === TRUE) {
            
        } else {
            echo "Error al subir la imagen: " . $conn->error;
        }
    } else {
        echo "Error al mover el archivo.";
    }
}

// Eliminar imagen
if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Obtener el nombre del archivo y la categoría de la base de datos
    $sql = "SELECT archivo, categoria FROM imagenes WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $archivo = $row['archivo'];
        $categoria = $row['categoria'];

        // Eliminar archivo del directorio
        $file_path = "uploads/" . $archivo;
        if (file_exists($file_path)) {
            unlink($file_path); // Eliminar archivo
        }

        // Eliminar imagen de la base de datos
        $sql_delete = "DELETE FROM imagenes WHERE id = $id";
        if ($conn->query($sql_delete) === TRUE) {
            
        } else {
            echo "Error al eliminar la imagen: " . $conn->error;
        }
    }
}

// Obtener imágenes de la categoría "Ocre"
$sql_ocre = "SELECT id, titulo, archivo FROM imagenes WHERE categoria = 'ocre' ORDER BY id DESC";
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
    <title>Subir y Ver Imágenes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(45deg, #000000, #FF6A00); /* Degradado de negro a naranja */
            color: #fff;
            margin: 0;
            padding: 0;
        }
        header {
            text-align: center;
            padding: 20px;
            background-color: #000; /* Fondo negro */
            color: white;
        }
        .form-container {
            margin: 20px auto;
            padding: 20px;
            max-width: 500px; /* Limitar ancho del formulario */
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .form-container input, 
        .form-container textarea, 
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            background: #1a1a1a;
            color: #fff;
        }
        .form-container button {
            background-color: #FF6A00; /* Naranja */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .form-container button:hover {
            background-color: #FF8C00; /* Naranja más claro */
        }
        .gallery-container {
            margin: 30px 20px;
        }
        .gallery-container-ocre {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .gallery-item {
            background: #1a1a1a; /* Fondo oscuro */
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 220px; /* Tamaño fijo de las tarjetas */
        }
        .gallery-item img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .gallery-item h3 {
            margin-top: 10px;
            color: #FF6A00; /* Naranja */
        }
        .gallery-item button {
            background-color: #FF6A00; /* Naranja */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .gallery-item button:hover {
            background-color: #FF8C00; /* Naranja más claro */
        }
        
    
    </style>
</head>
<body>
    <!-- Botón de Volver -->

    <header>
    <button class="back-button" onclick="window.location.href='index.php';" 
        style="position: absolute; left: 20px; top: 20px; background-color: #FF6A00; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;">
    Volver
</button>

        <h1>Subir y Ver Imágenes</h1>
    </header>

    <div class="form-container">
        <!-- Formulario para subir imágenes -->
        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="upload">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required><br>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea><br>

            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <option value="ocre">Ocre</option> <!-- Solo categoría "Ocre" -->
            </select><br>

            <label for="archivo">Archivo:</label>
            <input type="file" id="archivo" name="archivo" accept="image/*" required><br>

            <button type="submit">Subir Imagen</button>
        </form>
    </div>

    <div class="gallery-container">
        <!-- Mostrar imágenes de la categoría "Ocre" -->
        <h2>Categoría: Ocre</h2>
        <div class="gallery-container-ocre">
            <?php foreach ($imagenes_ocre as $imagen): ?>
                <div class="gallery-item">
                    <img src="uploads/<?php echo $imagen['archivo']; ?>" alt="<?php echo $imagen['titulo']; ?>">
                    <h3><?php echo $imagen['titulo']; ?></h3>
                    <form action="admin.php" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $imagen['id']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
