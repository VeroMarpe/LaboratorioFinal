<!DOCTYPE html>
<html>
<head>
    <title>Lista de usuarios registrados</title>
    <link rel="stylesheet" href="datosestilo.css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CursoSQL";

    // Conexión 
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consultar registos
    $sql = "SELECT * FROM FORMULARIO";
    $result = $conn->query($sql);

    // Mostrar registros
    if ($result->num_rows > 0) {
        
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido1"] . "</td>";
            echo "<td>" . $row["apellido2"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

    } else {
        echo "No hay ningún registro todavía.";
    }

    // Cerrar conexión
    $conn->close();
    ?>
</body>
</html>