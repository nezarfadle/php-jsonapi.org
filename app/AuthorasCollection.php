<?php  namespace App;

use JsonApi\Core\BaseCollectionTransformer;

class AuthorasCollection extends BaseCollectionTransformer
{

	public function __construct( $authors, $baseUrl )
	{
		parent::__construct( 'comments.authors', $authors, 'App\AuthorEntity', $baseUrl );
	}
	
}