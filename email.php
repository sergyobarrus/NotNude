<?php 
header('Content-Type: text/html; charset=utf-8');

require 'mailer/PHPMailerAutoload.php';

$data = array();
$errors = array();

if (empty($_POST["name"])) {
    $errors["name"] = "O nome é requirido";
}

if (empty($_POST["email"])){
    $errors["email"] = "O e-mail é requerido";
}

if (empty($_POST["message"])){
    $errors["message"] = "A messagem é requerida";
}

if (! empty($errors)){
    $data["success"] = false;
    $data["errors"] = $errors;
} else {
    $data['success'] = true;
    $data['name'] = $name;
    $data['email'] = $email;
    $data['subject'] = $subject;
    $data['message'] = $message;
}   

$name       =   filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$email      =   filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$subject    =   filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
$formMessage =  filter_var($_POST["message"], FILTER_SANITIZE_STRING);
$message    = '<p>O email seguinte foi enviado por: </p>';
$message    .= '<p>Nome: ' . $name . '</p>';
$message    .= '<p>Email: ' . $email . '</p>';
$message    .= '<p>Messagem: ' . $formMessage .'</p>';


//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->setLanguage('pt');
$mail->CharSet='utf-8'; 

$mail->isSMTP();                                    // Enable SMTP authentication
$mail->SMTPAuth = true;                             // Set mailer to use SMTP
$mail->Host = 'in-v3.mailjet.com';                     // Specify main and backup server (this is a fake name for the use of this example)             
$mail->Username = 'a684069b425f1109fc4e1edb8499407e';     // SMTP username
$mail->Password = 'c6dca264133c7c02b9a11db268e225d0';            // SMTP password
$mail->SMTPSecure = 'tls';                          // Enable encryption, 'ssl' also accepted                                   
$mail->Port = 587;                        
$mail->CharSet;                        

$mail->From = $email;
$mail->FromName = $name;
$mail->AddReplyTo($email,$name);
$mail->addAddress('sergyobarrus@gmail.com', 'NoteNude');  // Add a recipient

$mail->WordWrap = 50;                               // Set word wrap to 50 characters
$mail->isHTML(true);                                // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $message;
$mail->AltBody = $message;

$send = $mail->send();
if(!$send) {
   echo 'Ocorreu um erro ao enviar seu email!.';
   echo 'Mensagem de erro: ' . $mail->ErrorInfo;
   exit;
}

echo 'Mensagem enviada com sucesso!';

echo json_encode($data, JSON_PRETTY_PRINT);
?>