<?php  namespace App;

use JsonApi\Collection;

class CommentsCollection extends Collection
{

	public function __construct( $comments, $baseUrl )
	{
		parent::__construct( 'comments', $comments, 'App\CommentEntity', $baseUrl );
	}
	
}