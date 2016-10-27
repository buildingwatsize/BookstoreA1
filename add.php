	<?		
			$titleVar ='a';
			$authorVar ='a';
			$publisherVar ='a';
			$publish_dateVar ='a';
			$typeVar ='a';
			$languageVar ='a';
			$priceVar ='a';
			

			
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
	?>