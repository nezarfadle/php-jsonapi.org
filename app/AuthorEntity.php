<?php  namespace App;

use JsonApi\Core\BaseTransformer,
	JsonApi\Core\Attributes

;

class AuthorEntity extends BaseTransformer
{

	private $author;

	public function __construct( $author, $baseUrl, $sparseFieldsets = [] )
	{
		parent::__construct( $baseUrl, $sparseFieldsets );
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


}