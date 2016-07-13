<?php  namespace App;

use JsonApi\Core\BaseCollectionTransformer;

class CommentsCollection extends BaseCollectionTransformer
{

	public function __construct( $comments, $baseUrl )
	{
		parent::__construct( 'comments', $comments, 'App\CommentEntity', $baseUrl );
	}
	
}