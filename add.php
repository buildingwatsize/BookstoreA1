<html> 
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<title>Add New Book</title> 

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
			<!-- ADD SERVICE -->
			<h1> Add New Book </h1>
			<?php
				// FOR DISABLE ERROR INPUT NOTICE
				error_reporting( error_reporting() & ~E_NOTICE );
				// FOR CALL NUSOAP
				require("lib/nusoap.php");

			  	if($_POST['submit_add'] == "Submit") {
			        $client = new nusoap_client("http://ec2-54-169-255-210.ap-southeast-1.compute.amazonaws.com/book/server_wsdl.php?wsdl",true);
			        $add = array(
						'titleVar'=>$_POST['from_title'],
						'authorVar'=>$_POST['from_author'],
						'publisherVar'=>$_POST['from_publisher'],
						'publish_dateVar'=>$_POST['from_publish_date'],
						'typeVar'=>$_POST['from_type'],
						'languageVar'=>$_POST['from_language'],
						'priceVar'=>$_POST['from_price']
						);
			        $data = $client->call("add_book",$add);		
			        echo $data;
			    }
			?>
			<form method="POST">
				<p>
				title:
				<INPUT type="text" name="from_title" size="50" maxlength="100"><br>
				author:
				<INPUT type="text" name="from_author" size="50" maxlength="100"><br>
				publisher:
				<INPUT type="text" name="from_publisher" size="50" maxlength="100"><br>
				publish_date:
				<INPUT type="text" name="from_publish_date" size="50" maxlength="100"><br>
				type:
				<INPUT type="text" name="from_type" size="50" maxlength="100"><br>
				language:
				<INPUT type="text" name="from_language" size="50" maxlength="100"><br>
				price:
				<INPUT type="text" name="from_price" size="50" maxlength="100"><br>
				</p><br>
				<INPUT type="submit" name="submit_add" value="Submit">
			</form>
			<!-- ADD SERVICE -->
		</div>
	</body>
</html>
