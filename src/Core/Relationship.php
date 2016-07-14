<?php namespace JsonApi\Core;

use JsonApi\Utils\ArrayUtil;

class Relationship
{
	private $entity, $transformer, $baseUrl;

	public function __construct( $entity, $transformer, $baseUrl )
	{
		$this->entity = $entity;
		$this->transformer = $transformer;
		$this->baseUrl = $baseUrl;
	}

	public function getParticipant()
	{
		return $this->entity;
	}


	public function createTransformer()
	{
		$transformer = new $this->transformer( $this->entity, $this->baseUrl );

		if ( ArrayUtil::isEmpty( $this->entity ))
		{
			return new NullCollectionTransformer( $this->baseUrl, $transformer->getType() );
		}

		if( null === $this->entity ) {
			return new NullTransformer( $this->baseUrl, $transformer->getType() );
		}

		return $transformer;
		// return new $this->transformer( $this->entity, $this->baseUrl );
	}

	public function toResource( $sparseFieldsets = [] )
	{

		$transformer = new $this->transformer( $this->entity, $this->baseUrl );

		if ( ArrayUtil::isEmpty( $this->entity ))
		{
			$nullCollectionTransformer = new NullCollectionTransformer( $this->baseUrl, $transformer->getType() );
			return $nullCollectionTransformer->toResource();
		}

		if( null === $this->entity ) {
			$nullTransformer = new NullTransformer( $this->baseUrl, $transformer->getType() );
			return $nullTransformer->toResource();
		}

		return $transformer->getOnly( $sparseFieldsets )->toResource();
		// $resource = new $this->transformer( $this->entity, $this->baseUrl );
		// return $resource->getOnly( $sparseFieldsets )->toResource();
	}
	
}