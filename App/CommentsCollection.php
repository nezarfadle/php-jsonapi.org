<?php  namespace App;

use JsonApi\Collection;

class CommentsCollection implements Collection
{
	private $comments;

	public function __construct( $comments )
	{
		$this->comments = $comments;
	}
	
	public function getType()
	{
		return 'comments';
	}

	public function getIdentifiers()
	{
		$data = [];

		foreach ($this->comments as $comment) {
			$entity = new CommentEntity( $comment );
			$data[] = $entity->toIdentifier(); 
		}
		return $data;
	}

	public function getResources()
	{
		$data = [];

		foreach ($this->comments as $comment) {
			$entity = new CommentEntity( $comment );
			$data[] = $entity->toResource(); 
		}
		return $data;
	}

}