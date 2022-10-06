<?php
    require "Modelo/db.php";
    session_start();
    $usuario = $_SESSION['Usuario'];
    $id_rol= $_SESSION['Rol'];
    $sql = "SELECT * FROM rol WHERE id_Rol = '$id_rol'";
    $resultado = mysqli_query($con,$sql);
    $filas=mysqli_fetch_array($resultado);
    $rol = $filas['NombreRol'];
    mysqli_free_result($resultado);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso</title>

    <!-- JQuery v3.6.1 CDN-->
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- Bootstrap v5.1.3 CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FontAwesome v6.1.2 CDNs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/brands.min.css"
        integrity="sha512-nS1/hdh2b0U8SeA8tlo7QblY6rY6C+MgkZIeRzJQQvMsFfMQFUKp+cgMN2Uuy+OtbQ4RoLMIlO2iF7bIEY3Oyg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Archivo CSS -->
    <link rel="stylesheet" href="Vista/css/inicio.css">

</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class="fa-solid fa-bars" id="header-toggle"></i></div>
        <div class="header_usuario">
            <h4>¡Hola, <?php echo $usuario; ?>!</h4>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class="fa-regular fa-hospital nav_logo-icon"></i>
                    <span class="nav_logo-name">Santa Ana</span>
                </a>
                <div class="nav_list">
                    <a href="#" class="nav_link active">
                        <i class="fa-solid fa-gauge nav_icon"></i>
                        <span class="nav_name">Escritorio</span>
                    </a>
                    <?php
                    if ($id_rol==1){
                        echo '<a href="#" class="nav_link"><i class="fa-regular fa-user nav_icon"></i><span class="nav_name">Usuarios</span></a>';
                    }
                    ?>
                </div>
            </div>
            <a href="logout.php" class="nav_link">
                <i class='fa-solid fa-arrow-right-from-bracket nav_icon'></i>
                <span class="nav_name">Salir</span>
            </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        <h4>Opciones del <?php echo $rol ?></h4>
        <div class="menuRol py-4 px-3 m-4 border rounded">
            <div class="col">
                <div class="justify-content-center input-group">
                    <button class="btn btn-primary" type="submit" name="btnAfiliarCita" id="btnAfiliarCita">Afiliar Paciente</button>
                </div>
                <div class="justify-content-center input-group mt-3">
                    <button class="btn btn-primary" type="submit" name="btnReserarCita" id="btnReserarCita">Registrar reservación de cita</button>
                </div>
            </div>
        </div>
    </div>
    <!--Container Main end-->
</body>
<script async>
document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                // show navbar
                nav.classList.toggle('show')
                // change icon
                toggle.classList.toggle('fa-xmark')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')
            })
        }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink))

    // Your code to run since DOM is loaded and ready
});
</script>

</html>