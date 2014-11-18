<?php

$mailuser = $_POST['email'];
$mailusername = $_POST['nome'];
        
require './PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->setLanguage('pt');

$host       = 'smtp.gmail.com';
$username   = 'meuamigopedreiro@gmail.com';
$password   = 'meuamigopedreiro123';
$port       = '587';
$secure   = 'tls';

$from       = $username;
$fromName   = $mailusername;

$mail->isSMTP();
$mail->Host         = $host;
$mail->SMTPAuth     = true;
$mail->Username     = $username;
$mail->Password     = $password;
$mail->Port         = $port;
$mail->SMTPSecure   = $secure;


//Dados do remetente - Quem esta enviando
$mail->From         = $from; 
$mail->FromName     = $fromName; 
$mail->addReplyTo($from, $fromName); //dados de resposta

//Dados do destino - Quem esta recebendo
$mail->addAddress($mailuser, $mailusername); 

//Configurações do Email
$mail->isHTML(true);
$mail->CharSet      = 'utf8';
$mail->WordWrap     = 70; //limiute de palavras da linda (Quebra de linhas)

$mail->Subject      = '[MeuAmigoPedreiro] Novo Contato'; // Assunto
$mail->Body         = 'Olá! estou enteressado pelo projeto <b>MeuPedreiroAmigo</b>
                       <br/><br/>
                       Anote meus dados:
                       <br/>
                       <b>'.$mailusername.'</b> - '.$mailuser; // corpo de texto
$mail->AltBody      = 'Olá! estou enteressado pelo projeto MeuPedreiroAmigo - Anote meus dados: '.$mailusername.' - '.$mailuser; // Corpo em texto plano

$send = $mail->send();
if (!$send) {
    echo "E envio do e-mail falhou: ".$mail->ErrorInfo ;
} else {
    echo "Mensagem enviada com sucesso!";
}



