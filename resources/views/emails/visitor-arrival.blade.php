<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
</head>
<body>
      <p>Dear {{$handler_name}}</p>
      <p>I hope this message finds you well.</p>
      <p>This email is to inform you that a visitor has arrived to see you. Details of the visitor are provided below:</p>
      <ul>
            <li>Visitor's Name: {{$visitor_name}}</li>
            <li>Purpose of Visit: {{$purpose_of_visit}}</li>
            <li>Contact information: {{$visitor_phone_number}}</li>
      </ul>
      <p>Please make arrangements to meet the visitor at your earliest convenience.</p>
      <br>
      <br>
      <p>Regards,</p>
      <p>SASRA VMS</p>
</body>
</html>