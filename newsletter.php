<?php


try{
    $db= new PDO("sqlsrv:server = tcp:mozaic-server.database.windows.net,1433; Database = mozaic-db", "shashwat18702@gmail.com", "Shashwat-Microsoft");
}
catch (PDOException $e) {
    echo '<p> Something went wrong.</p>';
    echo '<br>';
    echo '<a href="http://localhost/Projects/startbootstrap-coming-soon-gh-pages/"> Back to homepage </a>';
    exit();
}

$customer = [
'first_name' => isset($_POST['firstname']) ? $_POST['firstname'] : NULL,
'last_name' => isset($_POST['lastname']) ? $_POST['lastname'] : NULL,
'email' => isset($_POST['email']) ? $_POST['email'] : NULL,
];


$db->prepare("
INSERT INTO newsletter ( email, first_name, last_name) VALUES (:email, :first_name, :last_name)
")->execute($customer);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new \PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'mozaic.create@gmail.com';
$mail->Password = 'wjnbitbzwspnnkik';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('mozaic.create@gmail.com');
$mail->addAddress($_POST["email"]);
$mail->isHTML(true);
$mail->Subject="Test mail";
$mail->Body = "This is a test message";

$mail->send();


/*if($check)
{
    echo "Mail sent successfully";
}
else
{
    echo "Not sent";
}*/
header("Location: http://localhost/Projects/startbootstrap-coming-soon-gh-pages/");
exit();
