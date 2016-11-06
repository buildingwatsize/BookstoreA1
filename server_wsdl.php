<?php
	require("lib/nusoap.php");
	 
	//Create a new soap server
	$server = new soap_server();

	//Define our namespace
	// $namespace = "http://localhost/nusoap/index.php";
	// $server->wsdl->schemaTargetNamespace = $namespace;
	 
	//Configure our WSDL
	$server->configureWSDL("BookStore");

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
				if($book_name==$value){
					 $title = $book[$i]->title ;
					 $author = $book[$i]->author ;
					 $publisher = $book[$i] -> publisher;
					 $publish_date = $book[$i] -> publish_date;
					 $type = $book[$i] -> type;
					 $language = $book[$i] -> language;
					 $price = $book[$i] -> price;
				     $result = "<b>Found ! [No.$i] </b> <br> &emsp; Title: $title <br> &emsp; Author: $author <br> &emsp; Publisher: $publisher <br> &emsp; Publish_date: $publish_date <br> &emsp; Type:$type <br> &emsp; Language: $language <br> &emsp; Price: $price <br><br>";    
				}						
			}
		}
		return $result!="" ? $result : "'$book_name' is not found.";
	}

	// Register Add Function
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
		'add_book',
		$addVar,
		array('return'=>'xsd:string')
		);
	function add_book($titleVar,$authorVar,$publisherVar,$publish_dateVar,$typeVar,$languageVar,$priceVar){
		$file = 'BookStore.xml';
		$xml = simplexml_load_file($file);

		$book = $xml->addChild('book');
		$book->addAttribute('category', 'new');
		$book->addChild('title', $titleVar);
		$book->title->addAttribute('lang', 'en');
		$book->addChild('author', $authorVar);
		$book->addChild('publisher', $publisherVar);
		$book->addChild('publish_date', $publish_dateVar);
		$book->addChild('type', $typeVar);
		$book->addChild('language',$languageVar);
		$book->addChild('price',$priceVar);			
		$xml->asXML($file);	
		
		return "Add (name) <b>$titleVar</b> Success <br><br>";
	}
	
	// Register Edit Function 
	$editVar = array(
		'from_name'=>'xsd:string',
		'to_name'=>'xsd:string'
		);
	$server->register(
		'edit_book',
		$editVar,
		array('return'=>'xsd:string')
		);
    function edit_book($from_name, $to_name) {
    	$xmlStr = file_get_contents('BookStore.xml');
		$xml = new SimpleXMLElement($xmlStr);
		$book = $xml->book;
		$edit_flag = 0;
		for($j=0;$j<sizeof($book);$j++){
			foreach ($book[$j] as $key => $value) {
				if($from_name==$value and $key=="title") {
					$book[$j]->title = $to_name;
					$edit_flag = 1;
				}
			}
		}			
		$output = $xml->asXML('BookStore.xml');		
		return $edit_flag == 1 ? "Edit Done ! (from) <b>$from_name</b> (to) <b>$to_name</b> <br><br>" : "<b>Sorry!</b> Unable to edit <b>$from_name</b> or We're not found that book. <br><br>";
	}
	 
	// Register Delete Function 
	$server->register(
		'delete_book',
		array('mark_name'=>'xsd:string'),
		array('return'=>'xsd:string')
		);
    function delete_book($mark_name) {
    	$name = $mark_name;			
		$xmlStr = file_get_contents('BookStore.xml'); 
		$xml = new SimpleXMLElement($xmlStr);
		$book = $xml->book;
		$delete_flag = 0;
		for($k=0;$k<sizeof($book);$k++){
			foreach ($book[$k] as $key => $value) {
				if($mark_name==$value and $key=="title"){
					$dom=dom_import_simplexml($book[$k]);
					$dom->parentNode->removeChild($dom);
					$delete_flag = 1;
					// MAY NOT USE 'unset' bcoz it will be not show the 'string' that we are returning.
					// unset($book[$k]);
				}
			}
		}			
		$output = $xml->asXML('BookStore.xml');		
		return $delete_flag == 1 ? "Delete (name) <b>$mark_name</b> Success! <br><br>" : "<b>Sorry!</b> Unable to delete <b>$mark_name</b> or We're not found that book. <br><br>";
	} 

	// Get our posted data if the service is being consumed
	// otherwise leave this data blank.
	$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
	 
	// pass our posted data (or nothing) to the soap service
	$server->service($POST_DATA);
	//exit(); 
?>
