<?php
    // Envio de e-mail com a classe PHPMailer e o serviço mailtrap.io
    // Se for necessário usar acentos ou carateres especiais ver no seguinte site:
    // https://www.homehost.com.br/blog/tutoriais/caracteres-especiais-acentos-html/

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "src/Exception.php";
    require "src/PHPMailer.php";
    require "src/SMTP.php";

    // se existir um post vamos usar o PHPMailer para enviar e-mail
    // 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // obtemos os dados necessários
        $nomeUtilizador = $_POST["name"];
        $emailUtilizador = $_POST["email"];
        $msgUtilizador = $_POST["msg"];
        $emailbiscateiro = $_POST["emailbiscateiro"];

        // configuracao
        $smtpUsername = "api"; // configuração do utilizador/password do mailtrap
        $smtpPassword = "87b5a4fca650a6ce405569f7909d9fa6";

        // configuração dos dados de quem envia o e-mail (FROM)
        $emailFrom = "mail@epbjc-porto.net"; // não mudar este email
        $emailFromName = "BiscatesPorto"; // configuração do nome aparecer no envio do email, pode ser alterado

        // configuração dos dados para onde o email vai ser enviado
        $emailTo = $emailbiscateiro;
        $emailToName = "BiscatesPorto";

        // configuração do PHPMailer
        $mail = new PHPMailer;
        $mail->isSMTP(); 
        $mail->SMTPDebug = 0; // DEBUG - 0 = off / 1 = client messages / 2 = client and server (depois colocar a zero 0)
        $mail->Host = "live.smtp.mailtrap.io";
        $mail->Port = 587; // porta de ligação
        //$mail->SMTPSecure = 'ssl'; // protocolo de segurança
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->setFrom($emailFrom, $emailFromName);
        $mail->addAddress($emailTo, $emailToName);
        $mail->Subject = "Mensagem em BiscatesPorto"; // configuração do assunto / subject
        $mail->msgHTML("<strong>BiscatesPorto</strong><p>Recebeu uma mensagem no BicatesPorto.</p><p>Nome: $nomeUtilizador</p><p>E-mail: $emailUtilizador</p><p>Mensagem: $msgUtilizador</p>");
        $mail->AltBody = "Envio de HTML nao suportado";


    // enviar o email e mostrar msg de sucesso ou erro
    if(!$mail->send()){
        echo "Erro no envio de mensagem: " . $mail->ErrorInfo;
    }else{
        echo "Mensagem enviada!";
    }

}
?>