<?php
require("ConexionBD.php");
session_start();     
        
        $nombre = $_SESSION['user'];
        $email = $_SESSION['Email'];
        $contra = $_SESSION['Contraseña'];      
        $ids = $_REQUEST['id'];

if(empty($_REQUEST['id'])){
    
        echo "Hubo un error con el id!!";
}else{
 
    $saldo;
    $precio;
    $newSaldo;
    
    
  
    
$sql1 = "SELECT C.Saldo , P.Precio, P.Concepto, C.ID
         FROM cliente AS C , producto AS P ,cliente_producto AS CP 
         WHERE C.ID = CP.ID_cliente AND P.idProducto = CP.id_producto AND C.Email = '$email' AND CP.Estado = 'Activo' AND CP.id_producto = $ids";
         
$result = $conn->query($sql1);


while ($row = $result->fetch_assoc()) {

$saldo = $row['Saldo'];
$precio = $row['Precio'];
$id_cliente = $row['ID'];

     if($saldo >= $precio){            
         $sql2 = "UPDATE cliente_producto SET Estado = 'Pago' WHERE id_producto = $ids"; 
          $conn->query($sql2);

          $newSaldo =  ($saldo - $precio); 
          $sql3 = "UPDATE cliente SET Saldo=($newSaldo) WHERE $id_cliente"; 
            $conn->query($sql3); 

              $conn->close();

            $produc = $row['Concepto'];
              header("location:Enviar_mail.php?nombre=$nombre&nombProd=$produc&email=$email");                   
              
     }else{
            $aux = TRUE;
            $conn->close();
            
            header("location:Menu1.php?respuesta=$aux");               
         }
            
}

}
?>