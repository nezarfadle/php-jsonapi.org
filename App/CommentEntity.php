<?php  namespace App;

use JsonApi\Entity,
	JsonApi\Attributes

;

class CommentEntity implements Entity
{

	private $comment;

	public function __construct( $comment )
	{
		$this->comment = $comment;
	}
	
	public function getId()
	{
		return $this->comment->id; 
	}

	public function getType()
	{
		return 'comments';
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
		$attributes->set( "name", $this->comment->name )->set( "email", $this->comment->email );
		return $attributes->get();
	}

	public function toRaw()
	{
		return $this->comment;
	}
}