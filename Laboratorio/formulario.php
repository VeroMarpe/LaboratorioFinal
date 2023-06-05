<?php
// Datos de conexión a la base de datos
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = '';
$dbname = "CursoSQL";

// Datos del formulario
$nombre = $_POST['nombre'] ?? '';
$apellido1 = $_POST['apellido1'] ?? '';
$apellido2 = $_POST['apellido2'] ?? '';
$email = $_POST['email'] ?? '';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';


// Validación de datos
if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($email) || empty($login) || empty($password)) {
  echo "Por favor, rellene todos los campos.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "El email no es válido.";
} elseif (strlen($password) < 4 || strlen($password) > 8) {
  echo "La contraseña debe tener entre 4 y 8 caracteres.";
} else {
  // Crear conexión
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname); 
  if ($conn->connect_error) {
    die("Error de conexión con la base de datos: " . $conn->connect_error);
  }
  
  // Comprobar si el email ya está registrado
  $emailExists = false;
  $checkEmailQuery = "SELECT * FROM FORMULARIO WHERE email='$email'";
  $checkEmailResult = $conn->query($checkEmailQuery);
  if ($checkEmailResult->num_rows > 0) {
    $emailExists = true;
  }
  
  if ($emailExists) {
    echo "El email ya está registrado.";
  } else {

    // Hashear contraseña
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insertar datos 
    $insertQuery = "INSERT INTO FORMULARIO (nombre, apellido1, apellido2, email, login, password) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$hashedPassword')";
    if ($conn->query($insertQuery) === true) {
    
     // Volver al formulario
     ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" href="style.css">
      </head>
      <body>
        <div class="container">
            <h1>Registro conseguido</h1>
            <p>Tu registro ha sido completado con éxito.</p>
            <a href="index.html">Volver al formulario</a>
        </div>
      </body>
      </html>
    <?php
  
    } else {
      echo "Error al registrar los datos: " . $conn->error;
    }
  }
// Cerrar conexión
$conn->close();
}
?>
