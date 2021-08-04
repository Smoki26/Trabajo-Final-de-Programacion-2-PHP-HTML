<?php
if(empty($_POST['email']) && empty($_POST['contrasena'])){ 

       header("location:index.php?str=Campos Incompletos");

}else{
require("ConexionBD.php");
                
$email = $_POST['email'];
$contra = $_POST['contrasena'];



session_start();


$sql = "SELECT * FROM cliente WHERE Password = '$contra' AND Email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
 
        if ($row > 0) {
            $_SESSION['user'] = $row['Usuario'];
            $_SESSION['saldo'] = $row['Saldo'];
            $_SESSION['ID'] = $row['ID'];
            $_SESSION['Email'] = $email;
            $_SESSION['Contraseña'] = $contra;
            
            $conn->close();
            
            header("location:Menu1.php");
        }
        else { 
            
            
            header("location:index.php?str=Contraseña o Email incorrecto");

            }
$conn->close();
}

?>