<?php  namespace App;

use JsonApi\Collection;

class AuthorasCollection extends Collection
{

	public function __construct( $authors, $baseUrl )
	{
		parent::__construct( 'comments.authors', $authors, 'App\AuthorEntity', $baseUrl );
	}
	
}