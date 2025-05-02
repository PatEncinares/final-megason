<!DOCTYPE html>
<html>
    <head>
	<title>Megason Diagnostic Clinic</title>

</head>

<body>
	Greetings {{ $data['user']->name }}! <br><br>
    Your account has been successfully created, please use the temporary password below to access your account <br>
    Temporary password : {{ $data['tempPass'] }}
        
	

</body>

</html>