<?php  namespace App;

use JsonApi\BaseTransformer,
	JsonApi\Attributes

;

class AuthorEntity extends BaseTransformer
{

	private $author;

	public function __construct( $author, $baseUrl )
	{
		parent::__construct( $baseUrl );
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

}