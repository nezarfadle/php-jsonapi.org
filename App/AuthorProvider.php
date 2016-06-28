<?php namespace App;

use JsonApi\BaseProvider,
	JsonApi\Resource,
	JsonApi\Attributes,
	JsonApi\Links

;

class AuthorProvider extends BaseProvider
{
	private $author;

	public function __construct( $author )
	{
		// parent::__construct( $author, new AuthorTransformer( $author ) );
		// parent::__construct( new AuthorEntity($author), new AuthorTransformer( $author ) );
		// parent::__construct( new AuthorEntity($author) );
		$this->author = $author;
	}
	
	public function getRelationship()
	{
		// return $this->transformer->getIdentity();
		$e = new AuthorEntity($this->author);
		return $e->getIdentity();
		// return $this->entity->getIdentity();
	}

	public function getIncluded()
	{
		// $id = $this->transformer->getIdentifier()->getId();
		// $id = $this->entity->getIdentifier()->getId();
		$r = new Resource([
			// 'main' => new AuthorTransformer( $this->entity ),
			'main' => new AuthorEntity( $this->author ),
			"features" => [
				"attributes", 'links'
			]
		]);
		return [
			$r->getSchema()
		];
	}
}