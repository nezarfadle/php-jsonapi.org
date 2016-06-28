<?php  namespace App;

use JsonApi\Entity,
	JsonApi\Attributes

;

class CommentEntity extends Entity
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

	public function getAttributes()
	{
		$attributes = new Attributes();
		$attributes->set( "title", $this->comment->title )->set( "body", $this->comment->body );
		return $attributes->get();
	}

	public function toRaw()
	{
		return $this->comment;
	}
}