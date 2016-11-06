<html> 
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<title>Delete Book</title> 

		<!-- DO NOT TOUCH THIS SCRIPT -->		
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
		<!-- <meta property="og:image" content="http://www.mhwebdesigns.com/templates/panel/images/preview.jpg"/> -->
		<script src="scripts/jquery-1.12.3.min.js"></script>
		<script src="scripts/main.js"></script>
	</head>
	<body>
		<div id="header">
			<div class="logo"><a href="#">CodeIS<span> WEB SERVICE </span><span style="font-size: 0.45em;">php</span></a></div>
			<div class="powered">Template by <a href="http://www.mhwebdesigns.com" target="_blank">MHWebDesigns.com</a></div>
	    </div>
	
		<div id="mhwebhold"></div>
		<div id="hold">
			<a class="mobile" href="#">MENU</a>
			<div id="container">
				<div class="sidebar">
					<ul id="nav">
						<li><a  href="#1"> HOME </a></li>
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
			<!-- DELETE SERVICE -->
			<h1> Delete Book </h1>
			<h2><font color="red">CAUTION ! IT WILL BE DELETE NODE IN XML FILE.</font></h2>
			<?php
			  	// FOR DISABLE ERROR INPUT NOTICE
				error_reporting( error_reporting() & ~E_NOTICE );
				// FOR CALL NUSOAP
				require("lib/nusoap.php");

				if($_POST['submit_delete'] == "Submit") {
					$mark_name=$_POST['mark_name'];
			        $client = new nusoap_client("http://ec2-54-169-255-210.ap-southeast-1.compute.amazonaws.com/book/server_wsdl.php?wsdl",true);
			        $params = array('mark_name'=>$mark_name);
			        $data = $client->call("delete_book",$params); 
			        echo $data;
			    }
			?>
			<form method="POST">	
				<p>Delete Book Name: 
				<INPUT type="text" name="mark_name" size="50" maxlength="100"></p>
				<INPUT type="submit" name="submit_delete" value="Submit">
				<br>
			</form>
			<!-- DELETE SERVICE -->
		</div>
	</body>
</html>
