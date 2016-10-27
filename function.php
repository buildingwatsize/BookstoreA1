<?php
	function price($name)
	{	
		$details=array(
			'abc'=>100,
			'xyz'=>200
		);	
		
		foreach($details as $n=>$p)
		{
			if($name==$n)
				$price=$p;
		}
		return $price;
	}
	function find($book)
	{
		$xmlStr=file_get_contents('BookStore.xml'); 
		$xml=new SimpleXMLElement($xmlStr);
		$ans=$xml->xpath("child::*");
		$i=0;
		for($i;$i<sizeof($ans);$i++){
			foreach ($ans[$i] as $key => $value) {
				if($book==$value)
					$result=$value;
			
			}
			
		}
		return $result;
	}
	function find_xml($book_xml)
	{
		$xmlStr=file_get_contents('BookStore.xml'); 
		$xml=new SimpleXMLElement($xmlStr);
		$ans=$xml->xpath("child::*");
		$i=0;
		for($i;$i<sizeof($ans);$i++){
			foreach ($ans[$i] as $key => $value) {
				if($book_xml==$value)
					$result=$i;
			
			}
			
		}
		return $result;
	}
?>