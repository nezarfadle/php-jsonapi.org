<?php  namespace App;

use JsonApi\Entity,
	JsonApi\Attributes

;

class ArticleEntity extends Entity
{

	private $article;

	public function __construct( $article )
	{
		$this->article = $article;
	}
	
	public function getId()
	{
		return $this->article->id; 
	}

	public function getType()
	{
		return 'articles';
	}

	public function getAttributes()
	{
		$attributes = new Attributes();
		$attributes->set( "title", $this->article->title )->set( "body", $this->article->body );
		return $attributes->get();
	}

	public function toRaw()
	{
		return $this->article;
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
}