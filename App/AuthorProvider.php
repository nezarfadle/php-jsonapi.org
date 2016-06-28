<?php namespace App;

use JsonApi\BaseProvider,
	JsonApi\Resource,
	JsonApi\Attributes,
	JsonApi\Links

;

class AuthorProvider extends BaseProvider
{

	public function __construct( $author )
	{
		parent::__construct( $author, new AuthorTransformer( $author ) );
	}
	
	public function getData()
	{
		return $this->transformer->getIdentity();
	}

	public function getIncluded()
	{
		$id = $this->transformer->getIdentifier()->getId();
		$r = new Resource([
			'main' => new AuthorTransformer( $this->entity ),
			"features" => [
				"attributes", 'links'
			]
		]);
		return [
			$r->getSchema()
		];
	}
}