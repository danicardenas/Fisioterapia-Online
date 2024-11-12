<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - Fisioterapia</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <header>
        <h1>Bienvenido a Tu Clínica de Fisioterapia</h1>
        <nav>
            <ul>
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#perfil">Perfil</a></li>
                <li><a href="#citas">Citas</a></li>
                <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    
    <section id="bienvenida">
        <h2>¡Hola, <?php echo $_SESSION['usuario']; ?>!</h2>
        <p>Nos alegra verte. Explora nuestros servicios y gestiona tus citas.</p>
    </section>
    
    <section id="servicios">
        <h3>Nuestros Servicios</h3>
        <ul>
            <li>Rehabilitación deportiva</li>
            <li>Terapia manual</li>
            <li>Masajes terapéuticos</li>
            <li>Electroterapia</li>
        </ul>
    </section>
    
    <section id="citas">
        <h3>Calendario de Citas</h3>
        <p>Reserva o revisa tus próximas citas.</p>
        <!-- Puedes agregar un calendario aquí -->
    </section>
    
    <footer>
        <p>Contacta con nosotros: +123 456 789 | info@fisioterapia.com</p>
        <p>Síguenos en redes sociales</p>
    </footer>
</body>
</html>