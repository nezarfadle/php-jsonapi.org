<?php namespace App;

use JsonApi\SingleResource,
	JsonApi\ResourceIdentifier,
	JsonApi\Attributes,
	JsonApi\Links,
	JsonApi\Transformer


;

class AuthorTransformer extends Transformer
{

	public function __construct( $author )
	{
		parent::__construct( new AuthorEntity( $author ) );
	}

	
}