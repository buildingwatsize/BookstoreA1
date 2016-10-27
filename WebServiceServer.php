<?php
		require("lib/nusoap.php");
		 
		//Create a new soap server
		$server = new soap_server();

		//Define our namespace
		// $namespace = "http://localhost/nusoap/index.php";
		// $server->wsdl->schemaTargetNamespace = $namespace;
		 
		//Configure our WSDL
		$server->configureWSDL("HelloWorld");
		 
		// Register our method and argument parameters
        $varname = array(
                   'strName' => "xsd:string",
				   'strEmail' => "xsd:string"
        );
        $server->register(
			'HelloWorld',
			$varname,
			array('return' => 'xsd:string')
			);
        function HelloWorld($strName,$strEmail) {
			return "Hello, World! $strName, Your email: $strEmail";
		}

		// Register Search Function
		$server->register(
			'find_book',
			array("book_name"=>'xsd:string'),
			//array("return"=>"tns:ArrayOfString")
			array("return"=>'xsd:string')
			);
		function find_book($book_name) {
			$xmlStr=file_get_contents('BookStore.xml'); 
			$xml=new SimpleXMLElement($xmlStr);
			$book=$xml->xpath("child::*");
			$result="";
			for($i=0;$i<sizeof($book);$i++){
				foreach ($book[$i] as $key => $value) {
					if($book_name==$value)
						$result="Found: [No.$i] $book_name ";
				}
			}
			return $result!="" ? $result : "'$book_name' is not found.";
		}
		
		// Register Edit Function 
		$editVar = array(
			'from_name'=>'xsd:string',
			'to_name'=>'xsd:string'
			);
		$server->register(
			'EditXML',
			$editVar,
			array('return'=>'xsd:string')
			);
        function EditXML($from_name,$to_name) {
			$xmlStr = file_get_contents('BookStore.xml'); 
			$xml = new SimpleXMLElement($xmlStr);

			$xml->book[0]->title = 'TEST';
			$output = $xml->asXML('BookStore.xml');

			return "Edit Done";
		}
		$addVar = array(
			'titleVar'=>'xsd:string',
			'authorVar'=>'xsd:string',
			'publisherVar'=>'xsd:string',
			'publish_dateVar'=>'xsd:string',
			'typeVar'=>'xsd:string',
			'languageVar'=>'xsd:string',
			'priceVar'=>'xsd:string'
			);
		$server->register(
			'AddXML',
			$addVar,
			array('return'=>'xsd:string')
			);
		function AddXML($titleVar,$authorVar,$publisherVar,$publish_dateVar,$typeVar,$languageVar,$priceVar){
			$file = 'BookStore.xml';
			$xml = simplexml_load_file($file);
			$xml->addAttribute('category', 'new');

			$book = $xml->addChild('book');
			$book->addChild('title lang="en"', $titleVar);
			$book->addChild('author', $authorVar);
			$book->addChild('publisher', $publisherVar);
			$book->addChild('publish_date', $publish_dateVar);
			$book->addChild('type', $typeVar);
			$book->addChild('language',$languageVar);
			$book->addChild('price',$priceVar);
			$xml->asXML($file);
			
			
			return "Suscess";
			
		}

		// Get our posted data if the service is being consumed
		// otherwise leave this data blank.
		$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
		 
		// pass our posted data (or nothing) to the soap service
		$server->service($POST_DATA);
		//exit(); 
?>
