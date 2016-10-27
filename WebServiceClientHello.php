<html>
<head>
<title>Client SOAP</title>
</head>
<body>
<?php
	// FOR DISABLE ERROR INPUT NOTICE
	error_reporting( error_reporting() & ~E_NOTICE );
	// FOR CALL NUSOAP
	require("lib/nusoap.php");
?>

<!-- HELLO WORLD SERVICE -->
<h1> <<< HelloWorld Service >>> </h1>
<?php
	error_reporting( error_reporting() & ~E_NOTICE );
	if($_POST['submit_hello'] == "Submit") {
		$client_name=$_POST['name_input'];
		$client_email=$_POST['email_input'];
        $client = new nusoap_client("http://localhost/book/WebServiceServer.php?wsdl",true); 
        $params = array(
                   'strName' => $client_name,
				   'strEmail' => $client_email
        );
       $data = $client->call("HelloWorld",$params); 
       echo $data;
    }
?>
<form method="POST">
	<p>Name: 
	<INPUT type="text" name="name_input" size="50" maxlength="100"> </p>
	<p>Email: 
	<INPUT type="email" name="email_input" size="50" maxlength="100"> </p>
	<INPUT type="submit" name="submit_hello" value="Submit">
	<br>
</form>
<!-- HELLO WORLD SERVICE -->

</body>
</html>
