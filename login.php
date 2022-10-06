<?php
    require "Modelo/db.php";
    session_start();
    if (isset($_POST['btnAcceder'])) {
        $correo = $_POST['txtEmail'];
        $clave = $_POST['txtClave'];
        $consulta="SELECT * FROM usuario WHERE Correo = '$correo' AND Clave = '$clave'";       
        $resultado=mysqli_query($con,$consulta);
        $filas=mysqli_fetch_array($resultado);
        if ($filas){
            $id_usuario = $filas['id_Usuario'];
            $rol = $filas['id_Rol'];
            $usuario = $filas['Nombre'].' '.$filas['Ape_Pat'].' '.$filas['Ape_Mat'];
            $_SESSION['id_usuario']=$id_usuario;
            $_SESSION['Usuario']=$usuario;
            $_SESSION['Rol']=$rol;
            header("location:inicio.php");
        } else {
            echo "<script async>alert('El usuario o la contraseña son incorrectos');</script>";
        }
        mysqli_free_result($resultado);
    }    
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso</title>

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
    <link rel="stylesheet" href="Vista/css/style.css">

</head>

<body>
    <section class="contenedorLogin">
        <div class="login-icono">
            <img src="Vista/img/logo-clinica.webp"></img>
        </div>
        <div class="login">
            <form class="row row-cols-lg-auto g-3 flex-column pt-5" action="" method="POST">

                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-text"><span><i class="fa-solid fa-at"></i></span></div>
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                            placeholder="Correo Electrónico">
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-text"><span><i class="fa-solid fa-key"></i></span></div>
                        <input type="password" class="form-control" id="txtClave" name="txtClave"
                            placeholder="Contraseña">
                    </div>
                </div>
                <!--<div class="form-group form-check">
                    <input class="form-check-input" type="checkbox" id="check">
                    <label class="form-check-label" for="check">Recuérdame</label>
                </div>-->
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input type="submit" class="btn btn-primary btn-lg" name="btnAcceder" value="Acceder">
                </div>
            </form>
        </div>
    </section>
</body>
<script async>
if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}
</script>

</html>