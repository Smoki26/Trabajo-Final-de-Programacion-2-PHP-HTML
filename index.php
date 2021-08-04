<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
         <link rel="stylesheet" href="Estilos.css?2021">
       
    </head>
   
    
           
    <body class="body">
   
    

        
        <!-- Formulario para inicio de sesion-->
        <div class="form">        
           <form  action="Verify.php" method="POST" >
               <h1 class="inicio_session"> Iniciar sesion </h1>
               <p>Email:</p> 
               <input id="input" type="email" name="email" required="" ></br> </br>
               <p>Contraseña:</p>   
               <input id="input" type="password" name="contrasena" required="" ></br> </br>
               <input class="input_boton" type="submit" name="boton" value="Aceptar"> </br> 
               <a href="Registrar.php"/> <p style="font-size: 10px">not a member? Sign up</p></a>
               <p style="color:red"><?php if(!empty($_REQUEST['str']))echo $_REQUEST['str'] ?></p>
           </form> 
        </div>
        
       
    </body>
</html>
