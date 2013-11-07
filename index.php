<?php
$to = "kazanlak6@gmail.com"; //имейла на който ще се пращат съобщенията
function alert($type, $mess)
{
echo '<div class="alert alert-'.$type.'">'.$mess.'</div>';
}
function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
   {
      $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

      $headers = "From: $from_user <$from_email>\r\n".
               "MIME-Version: 1.0" . "\r\n" .
               "Content-type: text/html; charset=UTF-8" . "\r\n";

     return mail($to, $subject, $message, $headers);
   }
 
if(isset($_POST['submit'])) 
{
	 $name = htmlspecialchars($_POST['name']);
	 $email = htmlspecialchars($_POST['email']);
	 $subject = htmlspecialchars($_POST['subject']);
	 $message = htmlspecialchars($_POST['message']);
		//валидация на имейла
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $error = alert('danger', 'Невалиден имейл'); } else {
			 mail_utf8($to, $name, $email, $subject, $message);
			$error = alert('success', 'Успешно изпратен имейл');
		}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="uphero">
    <title>Контактна форма</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
	
<?php
if(isset($error)) {
	echo $error;
} 
?>

      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Изпрати запитване</h2>
        <input type="text" class="form-control" placeholder="Вашето име" name="name" required autofocus>
        <input type="email" class="form-control" placeholder="Email" name="email" required autofocus>
        <input type="text" class="form-control" name="subject" placeholder="Тема" required>
        <textarea type="text" class="form-control" name="message" maxlength="999"placeholder="Съобщение" required></textarea>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Изпрати</button>
      </form>

    </div>
  </body>
</html>
