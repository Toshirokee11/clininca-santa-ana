<?php
    require "../Modelo/db.php";
    session_start();
    $usuario = $_SESSION['Usuario'];

    $sql = "SELECT MAX( id_Historial )+1 as id_Historial FROM historial_clinico";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $id_Historial = $row['id_Historial'];
    mysqli_free_result($result);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar reservación de citas</title>

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
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="contenedorCita">

        <!-- Datos de inicio -->

        <div class="d-flex justify-content-between py-3">
            <div class="w-50 input-group justify-content-start">
                <label class="me-4" for="txtRecepcionista">Recepcionista:</label>
                <input class="form-control" type="text" id="txtRecepcionista" value="<?php echo $usuario ?>" disabled>
            </div>
        </div>

        <!-- Formulario para registrar reservación de cita -->

        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Datos del paciente -->

            <div class="datosPaciente py-4 px-3 my-3 border rounded" id="datosPaciente">
                <div class="row d-flex justify-content-between">
                    <div class="col">
                        <div class="input-group mt-3">
                            <label class="me-4" for="txtDNI">DNI:</label>
                            <input type="text" class="form-control" id="txtDNI" name="txtDNI" minlength="8"
                                maxlength="8" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="txtApePat">Ape. Paterno:</label>
                            <input type="text" class="form-control solo-texto" id="txtApePat" name="txtApePat">
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="txtApeMat">Ape. Materno:</label>
                            <input type="text" class="form-control solo-texto" id="txtApeMat" name="txtApeMat">
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="txtNombre">Nombre(s):</label>
                            <input type="text" class="form-control solo-texto" id="txtNombre" name="txtNombre">
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="txtFechaNaci">Fecha Nacimiento:</label>
                            <input type="date" class="form-control" id="txtFechaNaci" name="txtFechaNaci">
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="slcGenero">Sexo:</label>
                            <select class="form-select" id="slcGenero" name="slcGenero">
                                <option disabled selected value> -- Elegir -- </option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="slcEstadoCivil">Estado Civil:</label>
                            <select class="form-select" id="slcEstadoCivil" name="slcEstadoCivil">
                                <option disabled selected value> -- Elegir -- </option>
                                <option value="C">Casado</option>
                                <option value="D">Divorciado</option>
                                <option value="S">Soltero</option>
                                <option value="V">Viudo</option>
                            </select>
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="txtCelular">Celular:</label>
                            <input type="text" class="form-control" id="txtCelular" name="txtCelular" maxlength="9"
                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="txtEmail">Email:</label>
                            <input type="email" class="form-control" id="txtEmail" name="txtEmail">
                        </div>
                        <div class="input-group mt-3">
                            <label class="me-4" for="txtDireccion">Direccion:</label>
                            <input type="text" class="form-control" id="txtDireccion" name="txtDireccion">
                        </div>
                        <div class="input-group my-3">
                            <label class="me-4" for="'">Historia Clinica:</label>
                            <input type="text" class="form-control" id="txtHistoria" name="txtHistoria"
                                value="<?php echo $id_Historial ?>" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="area-imagen mt-3">
                            <img id="frame" src="" class="img-fluid" />
                        </div>
                        <div class="input-group mt-3">
                            <input class="form-control" type="file" id="fileImagen" onchange="preview()"
                                accept="image/*" name="fileImagen">
                        </div>
                        <div class="input-group my-3 justify-content-center">
                            <button onclick="clearImage()" class="btn btn-primary">Eliminar imagen</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de registrar y salir -->

            <div class="registarCita row d-flex">
                <div class="col input-group justify-content-end">
                    <button class="btn btn-primary" type="submit" name="btnAfiliar" id="btnAfiliar">Generar Afilición
                        Paciente</button>
                </div>
                <div class="col input-group justify-content-start">
                    <button class="btn btn-danger" type="button" name="btnSalir" id="btnSalir">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </div>
            </div>

        </form>
    </section>
</body>
<script async>
window.onload = function() {
    var pagar = document.getElementById('btnSalir');
    pagar.onclick = function() {
        if (confirm(
                "¿Seguro que desea salir de Registro de reserva de cita? (Los datos ingresados no se guardarán)"
            )) {
            location.href = "../inicio.php";
        } else {
            return false;
        }
    }
}
</script>
<script async>
$(document).ready(function() {
    $('.solo-texto').keypress(function(e) {
        var tecla = e.keyCode;
        if (tecla >= 48 && tecla <= 57) {
            alert("Caracteres introducidos no son correctos. Debe ingresar Caracteres alfabéticos");
            e.preventDefault();
        }
    });
});
</script>
<script>
function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
}

function clearImage() {
    document.getElementById('fileImagen').value = null;
    frame.src = "";
}
if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}
</script>
<?php
    if (isset($_POST['btnAfiliar']) && !empty($_POST["txtDNI"]) && !empty($_POST["txtApePat"]) && !empty($_POST["txtApeMat"])
    && !empty($_POST["txtNombre"])  && !empty($_POST["txtFechaNaci"])  && !empty($_POST["slcGenero"]) && !empty($_POST["slcEstadoCivil"]) && !empty($_POST["txtCelular"]) 
    && !empty($_POST["txtEmail"]) && !empty($_POST["txtDireccion"]) && !empty($_FILES["fileImagen"]["tmp_name"])) {
        $dniPaci = $_POST["txtDNI"];
        $apePat = $_POST["txtApePat"];
        $apeMat = $_POST["txtApeMat"];
        $nombrePaci = $_POST["txtNombre"];
        $fechaNaci = $_POST["txtFechaNaci"];
        $generoPaci = $_POST["slcGenero"];
        $estadoCivil = $_POST["slcEstadoCivil"];
        $celularPaci = $_POST["txtCelular"];
        $emailPaci = $_POST["txtEmail"];
        $direccionPaci = $_POST["txtDireccion"];

        $query = "SELECT * FROM usuario WHERE DniUsuario = '$dniPaci'";
        $result = mysqli_query($con,$query);
        if($row = mysqli_fetch_array($result)){
            echo "<script async>alert('El DNI del usuario ya existe.');</script>";
        } else {
            $clavePaci = $id_Historial.substr($apePat,0,3).substr($apeMat,0,3).'@'.substr($nombrePaci,0,3);
            $query1 = "INSERT INTO usuario (DniUsuario,Clave,Ape_Pat,Ape_Mat,Nombre,Num_Telef,Correo,Direccion,FechaNaci,EstadoCivil,Sexo,id_Rol) 
            VALUES ('$dniPaci','$clavePaci','$apePat','$apeMat','$nombrePaci','$celularPaci','$emailPaci','$direccionPaci','$fechaNaci','$estadoCivil','$generoPaci',4)";
            mysqli_query($con,$query1);
            $idUsuario = mysqli_insert_id($con);

            $temporal = $_FILES["fileImagen"]["tmp_name"];
            $carpeta = "../Vista/img/pacientes";
            $ruta = $carpeta."/".$idUsuario;
            move_uploaded_file($temporal,$carpeta."/".$idUsuario.".jpeg");

            $query2 = "INSERT INTO paciente (id_Usuario, imagenPaci) VALUES ('$idUsuario','$ruta')";
            mysqli_query($con,$query2);
            $query3 = "INSERT INTO historial_clinico (id_Usuario) VALUES ('$idUsuario')";
            mysqli_query($con,$query3);
            //header("location:../inicio.php");
        }
    } else if (isset($_POST['btnAfiliar']) && (empty($_POST["txtDNI"]) || empty($_POST["txtApePat"]) || empty($_POST["txtApeMat"])
    || empty($_POST["txtNombre"])  || empty($_POST["txtFechaNaci"])  || empty($_POST["slcGenero"]) || empty($_POST["slcEstadoCivil"])  || empty($_POST["txtCelular"]) 
    || empty($_POST["txtEmail"]) || empty($_POST["txtDireccion"]) || empty($_FILES["fileImagen"]["tmp_name"]))) {
        echo "<script async>alert('Debe completar todos los campos antes de continuar con el registro.');</script>";
    }
?>

</html>