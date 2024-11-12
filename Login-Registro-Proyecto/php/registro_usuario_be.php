<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $contrasena = hash('sha512', $contrasena);

    //Encriptamiento de contraseña
    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
              VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";

//Verificar que el correo no se repita en la base de datos
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo ='$correo'");

if(mysqli_num_rows($verificar_correo) > 0){
    echo '
        <script>
            alert("Este correo ya esta registrado en otra cuenta, intenta con otro diferente");
            window.location = "../index.php"
        </script>
    ';
    exit();
}

//Verificar que el nombre de Usuario no se repita en la base de datos
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario ='$usuario'");

if(mysqli_num_rows($verificar_usuario) > 0){
    echo '
        <script>
            alert("Este nombre de Usuario ya esta registrado en otra cuenta, intenta con otro diferente");
            window.location = "../index.php"
        </script>
    ';
    exit();
}

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("ususario almacenado exitosamente");
                window.location ="../index.php";
            </script>
        ';
    }else{
        echo '
            <script>
                alert("Intentalo de nuevo, el usuario no fue almacenado");
                window.location = "../index.php";
                </script>
        ';
    }

    mysqli_close($conexion);
?>