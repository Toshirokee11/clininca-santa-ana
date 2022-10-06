<?php
    require "../Modelo/db.php";
    session_start();
    $usuario = $_SESSION['Usuario'];
    $id_paciente = "";
    $dni = "";
    $paciente = "";
    $historial = "";
    $correo = "";
    //$prueba = "Anastacia";
    if (isset($_POST['btnBuscar'])) {
        $dni = $_POST["txtDNIPaciente"];
        $consulta="SELECT * FROM usuario us, historial_clinico hc WHERE us.id_Usuario = hc.id_Usuario AND DniUsuario = '$dni'";       
        $resultado=mysqli_query($con,$consulta);
        $filas=mysqli_fetch_array($resultado);
        if ($filas){
            $id_paciente = $filas['id_Usuario'];
            $paciente = $filas['Nombre'].' '.$filas['Ape_Pat'].' '.$filas['Ape_Mat'];
            $historial = $filas['id_Historial'];
            $correo = $filas['Correo'];
        } else {
            echo "<script async>alert('No se encuentra afiliado el Paciente, necesita ser registrado primero');</script>";
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

        <div class="row d-flex justify-content-between py-3">
            <div class="col input-group justify-content-start">
                <label class="me-4" for="txtRecepcionista">Recepcionista:</label>
                <input class="form-control" type="text" id="txtRecepcionista" value="<?php echo $usuario ?>" disabled>
            </div>
            <div class="col input-group justify-content-end">
                <label class="me-4" for="txtFechaE">Fecha de misión:</label>
                <input class="form-control" type="text" id="txtFechaE" disabled>
            </div>
        </div>
        <div class="row d-flex py-3">
            <div class="col">
            </div>
            <div class="col input-group justify-content-end">
                <label class="me-4" for="txtDocumento">Estado de Documento:</label>
                <input class="form-control" type="text" id="txtDocumento" value="Pendiente" disabled>
            </div>
        </div>

        <!-- Buscar paciente -->

        <div class="buscarPaciente row py-4 px-3 my-3 border rounded">
            <form action="" method="POST" class="row d-flex">
                <div class="col input-group">
                    <label class="me-4" for="txtDNIPaciente">DNI Paciente:</label>
                    <input class="form-control" type="text" id="txtDNIPaciente" name="txtDNIPaciente" minlength="8"
                        maxlength="8" value="<?php echo $dni ?>"
                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                        placeholder="Ingrese DNI Paciente">
                </div>
                <div class="col">
                    <button class="btn btn-primary" type="submit" name="btnBuscar" id="btnBuscar"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>

        <!-- Formulario para registrar reservación de cita -->

        <form action="" method="POST">

            <!-- Datos del paciente -->

            <div class="datosPaciente row py-4 px-3 my-3 border rounded" id="datosPaciente">
                <div class="row d-flex justify-content-between py-3">
                    <div class="col input-group justify-content-end">
                        <label class="me-4" for="txtPaciente">Nombres y apellidos:</label>
                        <input class="form-control" type="text" id="txtPaciente" value="<?php echo $paciente ?>"
                            disabled>
                        <?php echo '<input type="hidden" name="txtIdPaciente" value="'.$id_paciente.'">'; ?>
                    </div>
                    <div class="col input-group justify-content-end">
                        <label class="me-4" for="txtHistorial">Nro. H. Clinico:</label>
                        <input class="form-control" type="text" id="txtHistorial" value="<?php echo $historial ?>"
                            disabled>
                    </div>
                </div>
                <div class="row d-flex justify-content-between py-3">
                    <div class="col input-group justify-content-end">
                        <label class="me-4" for="txtCorreo">Correo:</label>
                        <input class="form-control" type="text" id="txtCorreo" value="<?php echo $correo ?>" disabled>
                    </div>
                    <div class="col input-group justify-content-end">
                        <label class="me-4" for="txtCalidadP">Calidad del Paciente:</label>
                        <input class="form-control" type="text" id="txtCalidadP" value="<?php echo "Particular" ?>"
                            disabled>
                    </div>
                </div>
            </div>

            <!-- Motivos de la cita -->

            <div class="motivoCita row d-flex py-4 px-3 my-3 border rounded" id="motivoCita">
                <div class="col">
                    <label class="mb-3" for="txtMotivo">Motivo/Descripción de Cita:</label>
                    <textarea class="form-control" id="txtMotivo" name="txtMotivo" rows="3"></textarea>
                </div>
            </div>

            <!-- Buscar especialidad y médico -->

            <div class="buscarMedico row d-flex justify-content-between py-4 px-3 my-3 border rounded"
                id="buscarMedico">
                <div class="col input-group justify-content-end">
                    <label class="me-4" for="slcEspecialidad">Especialidad:</label>
                    <select id="slcEspecialidad" name="slcEspecialidad" class="form-select">
                        <option disabled selected value> -- Elegir-- </option>
                        <?php
                        $query="SELECT * FROM especialidad ORDER BY NombreEspecialidad ASC";
                        $res=mysqli_query($con,$query);
                        while($row=mysqli_fetch_array($res)){
                            echo '<option value="'.$row["id_Especialidad"].'">'.$row["NombreEspecialidad"].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col input-group justify-content-end">
                    <label class="me-4" for="slcMedico">Medico:</label>
                    <select id="slcMedico" name="slcMedico" class="form-select">
                        <option disabled selected value> -- Elegir-- </option>
                    </select>
                </div>
            </div>

            <!-- Buscar horario disponible para la cita -->

            <div class="turnoCita row d-flex justify-content-between py-4 px-3 my-3 border rounded" id="turnoCita">
                <div class="col elegirFecha">
                    <div class="input-group">
                        <label class="me-4" for="dtpFechaCita">Fecha de cita médica:</label>
                        <input class="form-control" type="date" id="dtpFechaCita" name="dtpFechaCita">
                    </div>
                </div>
                <div class="col input-group">
                    <label class="me-4" for="tbHorario">Horarios disponibles para cita médica:</label>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Horario Disponible</th>
                                <th scope="col">Selección</th>
                            </tr>
                        </thead>
                        <tbody id="horarioDisponible">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Botones de registrar y salir -->

            <div class="registarCita row d-flex">
                <div class="col input-group justify-content-end">
                    <button class="btn btn-primary" type="submit" name="btnRegistrar" id="btnRegistrar">Registrar cita</button>
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
<script async type="text/javascript" src="../Controlador/fechaHoy.js"></script>
<script async type="text/javascript" src="../Controlador/hallarMedico.js"></script>
<script async type="text/javascript" src="../Controlador/horarioDisponible.js"></script>
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
if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}
</script>
<?php 
    if (isset($_POST['btnRegistrar']) && !empty($_POST["txtIdPaciente"]) && !empty($_POST["slcMedico"]) 
    && !empty($_POST["slcEspecialidad"])  && !empty($_POST["rdHora"])  && !empty($_POST["dtpFechaCita"])  && !empty($_POST["txtMotivo"])) {
        $id_paciente= $_POST["txtIdPaciente"];
        $id_medico = $_POST["slcMedico"];
        $id_especialidad = $_POST["slcEspecialidad"];
        $id_horario = $_POST["rdHora"];
        $fecha = $_POST["dtpFechaCita"];
        $motivo = $_POST["txtMotivo"];

        //Comprobación de cantidad de citas por día
        $query = "SELECT * FROM horario hor, cita cit WHERE hor.id_horario = cit.id_Horario 
        AND cit.id_Paciente = '$id_paciente' AND hor.FechaCita = '$fecha'";
        $respuesta=mysqli_query($con, $query);
        $cantidad = mysqli_num_rows($respuesta);
        if($cantidad<=2){
            //Comprobación de cantidad de citas por especialidad
            $query1 = "SELECT * FROM horario hor, cita cit, medico med WHERE hor.id_horario = cit.id_Horario 
            AND cit.id_Paciente = '$id_paciente' AND hor.FechaCita = '$fecha' AND med.id_Especialidad = '$id_especialidad'";
            $res=mysqli_query($con, $query1);
            $cant = mysqli_num_rows($res);
            if($cant<1){
                $query2 = "INSERT INTO cita (id_Horario, id_Paciente, EstadoCita, Motivo) 
                VALUES('$id_horario', '$id_paciente', 'Pendiente', '$motivo')";
                mysqli_query($con, $query2);
                $query3 = "UPDATE horario SET Disponible = 'no' WHERE id_Horario = '$id_horario'";
                mysqli_query($con, $query3);
                echo "<script async>alert('Se realizó el registro correctamente');</script>";
            } else {
                echo "<script async>alert('No se puede realizar más reservas el día de hoy en la especialidad seleccionada, seleccione otra');</script>";
            }
        } else {
            echo "<script async>alert('No se puede realizar más reservas el día de hoy, el límite de reservas por día son 2, seleccione una fecha diferente');</script>";
        }
        mysqli_free_result($respuesta);
    } elseif (isset($_POST['btnRegistrar']) && (empty($_POST["txtIdPaciente"]) || empty($_POST["slcMedico"]) 
    || empty($_POST["slcEspecialidad"])  || empty($_POST["rdHora"])  || empty($_POST["dtpFechaCita"])  || empty($_POST["txtMotivo"]))) {
        echo "<script async>alert('Debe completar todos los campos antes de continuar con el registro.');</script>";
    }
?>

</html>