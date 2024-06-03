<?php

try{
    $db= new PDO("sqlsrv:server = tcp:mozaic-server.database.windows.net,1433; Database = mozaic-db", "CloudSAfe98238b", "hellomozaic@1");
    $customer = [
'email' => isset($_POST['email']) ? $_POST['email'] : NULL,
'first_name' => isset($_POST['firstname']) ? $_POST['firstname'] : NULL,
'last_name' => isset($_POST['lastname']) ? $_POST['lastname'] : NULL,

];


$db->prepare("
INSERT INTO dbo.newsletter ( email, first_name, last_name) VALUES (:email, :first_name, :last_name)
")->execute($customer);


}
catch (PDOException $e) {
    echo $e;
    echo '<br>';
    echo '<a href="https://mozaic.azurewebsites.net/"> Back to homepage </a>';
    exit();
}


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
$mail->Subject="Welcome to Mozaic - A New Home for Artists!";
$name = $_POST["firstname"];
$mail->Body = "Hello $name, <br> <br> Thank you for signing up for Mozaic! We're excited to have you join our community of passionate and talented artists.
<br> <br> Mozaic is the ultimate social media platform for artists of all kinds. Whether you're into painting, music, writing, photography, or any other form of art, Mozaic is here to help you share your work, connect with others, and find endless inspiration.
<br> <br> Here's What to Expect:<br>
-<b>Connect</b>with artists worldwide.<br>
-<b>Showcase</b>your art with our powerful tools.<br>
-<b>Grow</b>through exclusive content and workshops.<br><br>
Stay tuned for our launch date and exciting updates. Invite your artist friends to join too!
Thanks for joining Mozaic, $name. We can’t wait to see your art!<br><br> Best,<br> The Mozaic Team";

$mail->send();


/*if($check)
{
    echo "Mail sent successfully";
}
else
{
    echo "Not sent";
}*/
$message = "You are subscribed to Mozaic! Check your email for a welcome message.";
echo "<script type='text/javascript'>alert('$message'); window.location.href = 'https://mozaic.azurewebsites.net/';</script>";
exit();
