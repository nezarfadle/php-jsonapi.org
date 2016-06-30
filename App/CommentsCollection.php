<?php  namespace App;

use JsonApi\Collection;

class CommentsCollection extends Collection
{

	public function __construct( $comments )
	{
		parent::__construct( $comments, 'App\CommentEntity' );
	}
	
	public function getType()
	{
		return 'comments';
	}

}