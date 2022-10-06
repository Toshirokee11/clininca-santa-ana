<?php 
require_once "../Modelo/db.php";

$fechaCita=$_POST['fechaCita'];
$id_medico=$_POST['id_medico'];
$query="SELECT * FROM horario hor, medico med WHERE hor.FechaCita = '$fechaCita'
 AND med.id_Usuario = '$id_medico' AND med.id_Usuario = hor.id_Medico AND hor.Disponible = 'si'";
$res=mysqli_query($con,$query);
$rowcount=mysqli_num_rows($res);
if ($rowcount > 0) {
    while($row=mysqli_fetch_array($res)){
        echo '<tr><td><input type="hidden" name="txtIdHorario" value="'.$row['id_horario'].'">'.$row['HoraCita'].'</td><td><input class="form-check-input" type="radio" name="rdHora" value="'.$row['id_horario'].'"></td></tr>';
    }
} else {
    echo "<script async>alert('No tiene horario disponible para esta fecha.');</script>";
}

?>