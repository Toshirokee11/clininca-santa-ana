<?php 
require_once "../Modelo/db.php";

$id_especialidad=$_POST['id_especialidad'];

$query="SELECT * FROM usuario us, medico med
WHERE med.id_Especialidad = '$id_especialidad' AND med.id_Usuario = us.id_Usuario ORDER BY Nombre ASC";
$res=mysqli_query($con,$query);
echo '<option disabled selected value> -- Elegir-- </option>';
while($row=mysqli_fetch_array($res)){
    $medico=$row["Nombre"].' '.$row["Ape_Pat"].' '.$row["Ape_Mat"];
    echo '<option value="'.$row["id_Usuario"].'">'.$medico.'</option>';
}

?>