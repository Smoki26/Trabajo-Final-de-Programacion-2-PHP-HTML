<html>
    <head>
             
        <title>Menu</title>
        <link rel="stylesheet" href="Estilos.css?2022">


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
                        
                        $saldo = Saldo($email);
                    
                        ?>
                        
                    
                        
                    <nav class="nav">
                        <ul>
                            <h1 class="h1_skol"><em><a href="Menu1.php">Skol</a></em></h1>
                            <li class="li_bienvenido">Bienvenido <?php echo "".$_SESSION['user'];?>!!</li>
                            <b><li title="Saldo actual" class="li_saldo"><?php echo $saldo."$";?></li></b> 
                        </ul>
                    </nav>
                        
                        
                        <input type="checkbox" class="checkbox" id="check">
                        <label class="menu" for="check">|||</label>
                            <div class="left-panel">
                                <ul class="ul">
                                    <h1 class="h1_skol"><em>Skol</em></h1>             
                                    <a title="Volver al inicio" href="Menu1.php"><li class="li">Inicio</li></a>
                                    <a title="Historial de pago" href="Menu_de_pago.php"><li class="li">Compras</li></a>
                                    <a title="Cerrar session" href="cerrar_session.php"><li class="li">Cerrar Session</li></a>
                                </ul>
                            </div>    
                    
                        
                
                    <p id="sub-titulo"> Tabla de deudas</p>
                    
                
                    <table>
                        
                            <tr>
                                <td class="td_titulo">ID</td>
                                <td class="td_titulo">Nombre</td>
                                <td class="td_titulo">Precio</td>
                                <td class="td_titulo">Tipo</td>
                                <td class="td_titulo">Estado</td>
                                <td class="td_titulo">Accion</td>
                            </tr>
                    <?php
                    
                
                        

                    $sql = "SELECT CP.Estado , P.* FROM cliente AS C , producto AS P ,cliente_producto AS CP WHERE C.ID = CP.ID_cliente AND P.idProducto = CP.Id_producto AND C.Email = '$email' AND CP.Estado = 'Activo'";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                    ?>
                                <tr>
                                    <td> <?php echo $row['idProducto'] ?> </td>
                                    <?php $id = $row['idProducto']?>
                                    <td> <?php echo $row['Concepto'] ?> </td>
                                    <td style="color:#39A222"> <?php echo $row['Precio']."$" ?> </td>
                                    <td> <?php echo $row['Tipo'] ?> </td>
                                    <td> <?php echo $row['Estado'] ?> </td>
                                
                                    <td> <button onclick="location.href='Pago.php?id=<?php echo $id;?>'">Pagar</button> </td>             
                                </tr>
                            
                                
                    <?php

                }
                
                $conn->close();
                ?>
                        </table>
                    
                    <?php
                        TablaVacia($email);

                        if(isset($_REQUEST['respuesta']) == TRUE){
                            ?>
                                <script type="text/javascript">
                                    alert("Saldo Insuficiente");     
                                </script>
                            <?php
                            
                        }
                        
                        ?>
                        
                    
                        
                <?php
                        function TablaVacia($email){
                            require("ConexionBD.php");
                            $sql = "SELECT CP.Estado , P.* FROM cliente AS C , producto AS P ,cliente_producto AS CP WHERE C.ID = CP.ID_cliente AND P.idProducto = CP.Id_producto AND C.Email = '$email' AND CP.Estado = 'Activo'";
                            $result = $conn->query($sql);
                            
                            if(empty($result->fetch_assoc())){
                ?>
                                <br><br><h1 id="color3">No has comprado nada aun!!</h1>
                                <?php
                            }
                                
                            mysqli_close($conn);
                        }

                        function Saldo($email){
                            require("ConexionBD.php");
                            $sql = "SELECT Saldo FROM cliente WHERE Email = '$email'";
                            $result = $conn->query($sql);
                            
                            while($row = $result->fetch_assoc()){
                                return $row['Saldo'];
                            }
                        }


                        ?>
    </body>
 </html>
 
 

  