<html>
	<head> 
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<title>Edit Book</title> 

		<!-- DO NOT TOUCH THIS SCRIPT -->		
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
		<!-- <meta property="og:image" content="http://www.mhwebdesigns.com/templates/panel/images/preview.jpg"/> -->
		<script src="scripts/jquery-1.12.3.min.js"></script>
		<script src="scripts/main.js"></script>
	</head>
	<body>
		<div id="header">
			<div class="logo"><a href="http://ec2-54-169-255-210.ap-southeast-1.compute.amazonaws.com/book/">CodeIS<span> WEB SERVICE </span><span style="font-size: 0.45em;">php</span></a></div>
			<div class="powered">Template by <a href="http://www.mhwebdesigns.com" target="_blank">MHWebDesigns.com</a></div>
	    </div>
	
		<div id="mhwebhold"></div>
		<div id="hold">
			<a class="mobile" href="#">MENU</a>
			<div id="container">
				<div class="sidebar">
					<ul id="nav">
						<li><a  href="http://ec2-54-169-255-210.ap-southeast-1.compute.amazonaws.com/book/"> HOME </a></li>
						<li><a  href="BookStore.xml"> LIST BOOK </a></li>
						<li><a  href="search.php"> SEARCH BOOK </a></li>	
						<li><a  href="add.php"> ADD NEW BOOK</a></li>	
						<li><a  href="edit.php"> EDIT BOOK </a></li>
						<li><a  href="delete.php"> DELETE BOOK </a></li>
						<li><a  href="server_wsdl.php"> WSDL </a></li>	
						<li><a  href="https://github.com/buildingwatsize/BookstoreA1"> Github </a></li>
					</ul>
					<a class="menuclose" href="#">X Close Menu</a>
				</div>
			</div>
		</div>
	
		<div class="content">
			<!-- EDIT SERVICE -->
			<h1> Edit Book </h1>
			<?php
				// FOR DISABLE ERROR INPUT NOTICE
				error_reporting( error_reporting() & ~E_NOTICE );
				// FOR CALL NUSOAP
				require("lib/nusoap.php");

			  	if($_POST['submit_edit'] == "Submit") {
					$from_name=$_POST['from_name'];
					$to_name=$_POST['to_name'];
			        $client = new nusoap_client("http://ec2-54-169-255-210.ap-southeast-1.compute.amazonaws.com/book/server_wsdl.php?wsdl",true);
			        $params = array(
						'from_name'=>$from_name,
						'to_name'=>$to_name
						);
			        $data = $client->call("edit_book",$params); 
			        echo $data;
			    }
			?>
			<form method="POST">
				<p>
					From Book Name: 
					<INPUT type="text" name="from_name" size="50" maxlength="100">
					TO:
					<INPUT type="text" name="to_name" size="50" maxlength="100"> 
					<INPUT type="submit" name="submit_edit" value="Submit">
				</p>
			</form>
			<!-- EDIT SERVICE -->
		</div>
	</body>
</html>
