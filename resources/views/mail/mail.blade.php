<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
</head>
<body>

    <h3>Nuova candidatura</h3>
    <h6>Nome: {{$contact->name}}</h6>
    <h6>Email: {{$contact->email}}</h6>
    <h6>Telefono: {{$contact->phone}}</h6>
    <h6>Messaggio: {{$contact->body}}</h6>

</body>
</html>