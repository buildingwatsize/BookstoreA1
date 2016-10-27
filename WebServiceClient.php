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

<!-- SEARCH SERVICE -->
<h1> Search Book By Name Service </h1>
<?php
  	if($_POST['submit_search'] == "Submit") {
		$book_name=$_POST['book_name'];
        $client = new nusoap_client("http://localhost/book/WebServiceServer.php?wsdl",true); 
        $params = array("book_name"=>$book_name);
       $data = $client->call("find_book",$params); 
       echo $data;
    }
?>
<form method="POST">
	<p>Book Name: 
	<INPUT type="text" name="book_name" size="50" maxlength="100"> </p>
	<INPUT type="submit" name="submit_search" value="Submit">
	<br>
</form>
<!-- SEARCH SERVICE -->

</body>
</html>
