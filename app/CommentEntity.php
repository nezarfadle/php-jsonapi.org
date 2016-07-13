<?php  namespace App;

use JsonApi\Core\BaseTransformer,
	JsonApi\Core\Attributes

;

class CommentEntity extends BaseTransformer
{

	private $comment;

	public function __construct( $comment, $baseUrl, $sparseFieldsets = [] )
	{
		parent::__construct( $baseUrl, $sparseFieldsets );
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
	
}