<?php
try{
    $to      = 'luisvalve_1997@hotmail.com';
    $subject = 'the subject';
    $message = 'hello';
    $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: luisvalve34@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    if(mail($to, $subject, $message, $headers)){
        echo json_encode($resultado,true);
    }else{
        echo 'error';
    }
}catch(Exception $exc){
    Funciones::mensaje($exc->getMessage(), "e");
}
?>