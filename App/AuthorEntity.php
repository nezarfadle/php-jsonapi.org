<?php  namespace App;

use JsonApi\Attributes
;

class AuthorEntity
{

	private $author;

	public function __construct( $author )
	{
		$this->author = $author;
	}
	
	public function getId()
	{
		return $this->author->id; 
	}

	public function getType()
	{
		return 'authors';
	}

	public function getIdentity()
	{
		return [
			"type" => $this->getType(), 
			"id" => (string) $this->getId()
		];
	}

	public function getAttributes()
	{
		$attributes = new Attributes();
		$attributes->set( "name", $this->author->name )->set( "email", $this->author->email );
		return $attributes->get();
	}

	public function toRaw()
	{
		return $this->author;
	}
}