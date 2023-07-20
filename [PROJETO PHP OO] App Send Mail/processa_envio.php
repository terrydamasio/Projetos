<?php
    //adicionando biblioteca PHPMailer
    require './bibliotecas/PHPMailer/Exception.php';
    require './bibliotecas/PHPMailer/OAuth.php';
    require './bibliotecas/PHPMailer/PHPMailer.php';
    require './bibliotecas/PHPMailer/POP3.php';
    require './bibliotecas/PHPMailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //1) Enviar os dados do frontend para o back usando post
    //print_r($_POST);

    //2) criar a classe mensagem, seus atributos e funções
    class Mensagem {
        private $para = null;
        private $assunto = null;
        private $mensagem = null;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function mensagemValida() {
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
                return false;
            } 

            return true;
        }
    }

    $mensagem = new Mensagem();

    //3) recuperando os dados da superglobal $_POST e preenchendo os atributos do objeto
    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    if(!$mensagem->mensagemValida()) {
        echo 'Mensagem não é valida';
        die();
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'terrycaca14@gmail.com';                     //SMTP username
        $mail->Password   = 'iupgorfxytewutux';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('terrycaca14@gmail.com', 'Mailer');
        $mail->addAddress($mensagem->__get('para'));     
        //$mail->addReplyTo('info@example.com', 'Information');
        //;$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');        
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $mensagem->__get('assunto');
        $mail->Body    = $mensagem->__get('mensagem');
        $mail->AltBody = 'É necessário ultilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem.';

        $mail->send();
        echo 'Email enviado com sucesso.';
    } catch (Exception $e) {
        echo "Detalhes do erro: {$mail->ErrorInfo}";
    }   
?>