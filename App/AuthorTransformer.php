<?php namespace App;

use JsonApi\Transformer
;

class AuthorTransformer extends Transformer
{

	public function __construct( $author )
	{
		parent::__construct( new AuthorEntity( $author ) );
	}

	
}