<?php  namespace App;

use JsonApi\BaseCollection;

class AuthorasCollection extends BaseCollection
{

	public function __construct( $authors, $baseUrl )
	{
		parent::__construct( 'comments.authors', $authors, 'App\AuthorEntity', $baseUrl );
	}
	
}