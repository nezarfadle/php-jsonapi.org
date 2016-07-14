<?php namespace Test\Transformers;

use JsonApi\Core\BaseTransformer,
	JsonApi\Core\Attributes

;

class CommentTransformer extends BaseTransformer
{

	public function __construct( $baseUrl = 'http://fake.com', $sparseFieldsets = [] )
	{
		parent::__construct( $baseUrl, $sparseFieldsets );
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