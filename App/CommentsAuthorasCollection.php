<?php  namespace App;

use JsonApi\Collection;

class CommentsAuthorasCollection extends Collection
{

	public function __construct( $authors )
	{
		parent::__construct( 'comments.authors', $authors, 'App\AuthorEntity' );
	}
	
}