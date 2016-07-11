<?php  namespace App;

use JsonApi\BaseCollection;

class CommentsCollection extends BaseCollection
{

	public function __construct( $comments, $baseUrl )
	{
		parent::__construct( 'comments', $comments, 'App\CommentEntity', $baseUrl );
	}
	
}