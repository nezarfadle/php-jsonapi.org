<?php  namespace App;

use JsonApi\BaseEntity,
	JsonApi\Attributes

;

class CommentEntity extends BaseEntity
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

	public function toRaw()
	{
		return $this->comment;
	}

	public function getAttributes()
	{
		$attributes = new Attributes();
		$attributes->set( "title", $this->comment->title )->set( "body", $this->comment->body );
		return $attributes->get();
	}

	public function getLinks()
	{
		return [
			'self' => 'http://example.com/comments/' . $this->getId()
		];
	}
	
}