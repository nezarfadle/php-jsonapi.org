<?php  namespace App;

use JsonApi\BaseCollectionTransformer;

class AuthorasCollection extends BaseCollectionTransformer
{

	public function __construct( $authors, $baseUrl )
	{
		parent::__construct( 'comments.authors', $authors, 'App\AuthorEntity', $baseUrl );
	}
	
}