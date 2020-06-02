<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
  <body>
    Hello <strong>{{ $name }}</strong>,
    <p>{{body}}</p>
  </body>
</html>

//수정중
$to_name = ‘RECEIVER_NAME’;
$to_email = ‘RECEIVER_EMAIL_ADDRESS’;
$data = array(‘name’=>”Ogbonna Vitalis(sender_name)”, “body” => “A test mail”);
Mail::send(‘emails.mail’, $data, function($message) use ($to_name, $to_email) {
  $message->to($to_email, $to_name)
  ->subject(Laravel Test Mail’);
  $message->from(‘SENDER_EMAIL_ADDRESS’,’Test Mail’);
});
