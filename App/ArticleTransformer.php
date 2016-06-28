<?php namespace App;

use JsonApi\ResourceIdentifier,
	JsonApi\Attributes
;

class ArticleTransformer
{
	private $article;

	public function __construct( $article )
	{
		$this->article = $article ;
	}

	public function getMeta()
	{
		return [
			"copyright" => "Copyright 2015 Example Corp.",
		    "authors" => [
		      "Yehuda Katz",
		      "Steve Klabnik",
		      "Dan Gebhardt",
		      "Tyler Kellen"
		    ]
		];
	}

	public function getJsonApi()
	{
		return "1.0";
	}

	public function getLinks()
	{
		return [
			"self" => "http://exmaple.com/api/v1"
		];
	}
	
	public function getIdentifier()
	{
		return new ResourceIdentifier( 'artciles' , $this->article->id );
	}

	public function getAttributes()
	{
		$attributes = new Attributes();
		$attributes->set( "title", $this->article->title )
			  ->set( "body", $this->article->body );

		return $attributes->get();
	}
	
}