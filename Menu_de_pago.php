<!DOCTYPE html>

<html>
    <head>
        
        <title>Compras</title>
            <link rel="stylesheet" href="Estilos.css?2022">
        <style>
           
        </style>
    </head>
    
    
    <body>
        <?php
        session_start();
        
        require("ConexionBD.php");
        
       
        $email = $_SESSION['Email'];
        $contra = $_SESSION['Contraseña'];  
        if(!isset($email) && !isset($contra)){
                        
            header("location:index.php");
            
            die();
        }

        ?>
        
        <input type="checkbox" class="checkbox" id="check">
        <label class="menu" for="check">|||</label>
        <div class="left-panel">
            <ul class="ul">
                <li title="Saldo actual" class="item"><p><?php echo "$".$_SESSION['saldo'];?></p></li>
                <a title="Volver al inicio" href="Menu1.php"><li class="li">Inicio</li></a>
                <a title="Historial de pago" href="Menu_de_pago.php"><li class="li">Compras</li></a>
                <a title="Cerrar session" href="cerrar_session.php"><li class="li">Cerrar Session</li></a>
            </ul>
        </div>    
     
       
        <p id="sub-titulo"> Historial de compras</p>
        
        <table>
            <tr>
                <td class="td_titulo">ID</td>
                <td class="td_titulo">Nombre</td>
                <td class="td_titulo">Precio</td>
                <td class="td_titulo">Tipo</td>
                <td class="td_titulo">Estado</td>
            </tr>
        
        <?php
       
        
        
$sql = "SELECT CP.Estado , P.* FROM cliente AS C , producto AS P ,cliente_producto AS CP WHERE C.ID = CP.ID_cliente AND P.idProducto = CP.Id_producto AND C.Email = '$email' AND CP.Estado = 'Pago'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    ?>
                <tr>
                    <td> <?php echo $row['idProducto'] ?> </td>
                    <td> <?php echo $row['Concepto'] ?> </td>
                    <td style="color:#39A222"> <?php echo $row['Precio']."$" ?> </td>
                    <td> <?php echo $row['Tipo'] ?> </td>
                    <td> <?php echo $row['Estado'] ?> </td>
                                   
                    
                    
                </tr>
        <?php
}
mysqli_close($conn);
?>
        </table>
        <?php
        TablaVacia($servername,$username,$password,$db,$email);
        ?>
        
        
        <?php
        function TablaVacia($servername,$username,$password,$db,$email){
            $conn = new mysqli($servername, $username, $password, $db);
            $sql = "SELECT CP.Estado , P.* FROM cliente AS C , producto AS P ,cliente_producto AS CP WHERE C.ID = CP.ID_cliente AND P.idProducto = CP.Id_producto AND C.Email = '$email' AND CP.Estado = 'Pago'";
            $result = $conn->query($sql);      
            if(empty($result->fetch_assoc())){
                ?>
                 <br><br><h1 id="color3">No has Pagado nada aun!!</h1>
                <?php
            }        
            mysqli_close($conn);
        }
        ?>
        
    </body>
    </html>
