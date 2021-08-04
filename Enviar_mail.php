<html>
    <head>
        
    </head>

    <body>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    


            $nombre = $_REQUEST['nombre'];
            $email = $_REQUEST['email'];          
            $nombProd = $_REQUEST['nombProd'];
            $asunto = "Ah realizado un Pago!";
            $mensaje = "Hola ".$nombre."\n"."Se ah realizado un Pago de una compra de: ".$nombProd."\n"."Atte: su Servidor!";
            
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       //numero de errores
                $mail->isSMTP();                                            //protocolo
                $mail->Host       = 'smtp.gmail.com';                       //servicio de correo a usar
                //servers
                $mail->SMTPAuth   = true;                                  
                $mail->Username   = 'Pruebas.version.01@gmail.com';         //Direccion del correo desde donde se envia
                $mail->Password   = '18204625';                             //Contraseña del correo desde donde se envia
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    

                //Recipients
                $mail->setFrom('Pruebas.version.01@gmail.com','Skol');   //desde donde se enviara
                $mail->addAddress($email);                                //a quien se envia
               

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $asunto;
                $mail->Body    = $mensaje;
               

                $mail->send();
                
                header("location:Menu1.php");

            } catch (Exception $e) {
                echo "Error: {$mail->ErrorInfo}";
            }
        
    
?>

</body>
</html>