<?php namespace App;

use JsonApi\SingleResource,
	JsonApi\Attributes,
	JsonApi\Links

;

class AuthorProvider
{

	private $transformer, $author;

	public function __construct( $author )
	{
		$this->transformer = new AuthorTransformer( $author );
		$this->author = $author;
	}
	
	public function getData()
	{
		return $this->transformer->getIdentity();
	}

	public function getIncluded()
	{
		$id = $this->transformer->getIdentifier()->getId();
		$r = new SingleResource([
			'main' => new AuthorTransformer( $this->author ),
			"features" => [
				"attributes", 'links'
			]
		]);
		return [
			$r->getSchema()
		];
	}
}