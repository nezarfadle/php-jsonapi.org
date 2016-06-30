<?php  namespace App;

use JsonApi\BaseEntity,
	JsonApi\Attributes

;

class AuthorEntity extends BaseEntity
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

	public function getLinks()
	{
		return [
			'self' => 'http://example.com/author/' . $this->getId()
		];
	}
}