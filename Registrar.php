<!DOCTYPE html>
<html>
    <head>
        
        <title>Registrar</title>
        <link rel="stylesheet" href="Estilos.css?2021">
        
    </head>
    
    
    <body class="body">
        
        <?php
        
class Cliente{       
    public $usuario;              
    public $password;
    public $email; 
    public $saldo;
          
      
          function __construct($usuario,$email,$password,$saldo) {
            $this->usuario =  $usuario;
            $this->password = $password;
            $this->email =    $email;
            $this->saldo = $saldo;
          } 
}       
   
?>
    
   
    <br><br><br>
    
    <div class="form">  
            <form  action="Registrar.php" method="POST" >
                  <h1 class="inicio_session"> Registrar </h1>
                    <p>Usuario:</p>
                    <input id="input" type="text" name="user" required=""></br> </br>
                    <p>Email:</p>    
                    <input id="input" type="email" name="email" required=""></br> </br>
                    <p>Contraseña:</p>
                    <input  id="input" type="password" name="contrasena" required=""></br> </br>
                    <input class="input_boton" type="submit" name="boton" value="Sign up"> </br>          
                </form>
    </div>
      
<?php
      
        require("ConexionBD.php");
        
if (isset($_POST['boton'])) {
    if(empty($_POST['email']) and empty($_POST['contrasena']) and empty($_POST['user'])){
       
        ?>  
            <script> alert("Faltan campos por completar!!"); </script>
        <?php
  } else {
            $cliente1 = new Cliente($_POST['user'], $_POST['email'], $_POST['contrasena'],0);

            session_start();
           
            $sql1 = "INSERT INTO cliente(Usuario,Password,Email,Saldo) VALUE('$cliente1->usuario','$cliente1->password','$cliente1->email','$cliente1->saldo')";
            
            $ejecutar = $conn->query($sql1); 
            
            if ($ejecutar == TRUE) {

                $_SESSION['user'] = $cliente1->usuario;
                $_SESSION['saldo'] = $cliente1->saldo;
                $_SESSION['Email'] = $cliente1->email;
                $_SESSION['Contraseña'] = $cliente1->password;
          
                header("location:Menu1.php");
               
            } else {
                ?>
                <script> alert("Error al guardar!!"); </script>
                <?php
              
            }
            $conn->close();
        }
    }
    ?>
    </body>
   
</html>




