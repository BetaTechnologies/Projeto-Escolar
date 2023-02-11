<?php 

    //URL
    $url = "localhost:8000";

    //Functions
    function dd($var) {
        var_dump($var);
        die();
    }    

    function hd($local = "/") {
        header("Location: $local");
        die();
    }

    //Sessions
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    
    //Connection Database
    try {
       $pdo = new PDO("mysql:host=localhost;dbname=beta", "root", "");
    } catch (\Throwable $e) {
        echo "Erro ao conectar-se ao banco de dados: " . $e->getMessage();
    }

    //Create DateTime
    $date_time = new DateTime(); 
    date_default_timezone_set('America/Sao_Paulo');
    $date_time = date("d/m/Y H:i:s");

    //PHPMailer
    require '../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";
    
    $mail->isSMTP();                                            
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           
    $mail->Host       = 'smtp.mailtrap.io';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Port       = 2525;                                                            
    $mail->Username   = '23f5ec68398408';                                         
    $mail->Password   = '84a4a0078eb6ce';
        
    //DOMPdf
    use Dompdf\Dompdf;
    use Dompdf\Options;

    //Instancia do objeto options
    $options = new Options();
    $options->setChroot(__DIR__);

    //Instancia do objeto DOMPdf
    $dompdf = new Dompdf($options);
    $dompdf->set_option('enable_css_float', TRUE);
    $dompdf->set_option('enable_remote', TRUE);
    $dompdf->set_option('isPhpEnabled', TRUE);