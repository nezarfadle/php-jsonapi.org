<?php  namespace JsonApi;

use JsonApi\Collections\EntitiesCollection;

abstract class BaseCollection
{
	private $type, $entities, $transformer, $baseUrl, $sparseFieldsets;

	public function __construct( $type, $entities, $transformerClassName, $baseUrl )
	{
		$this->type = $type;
		$this->entities = new EntitiesCollection( $entities );
		$this->transformer = $transformerClassName;
		$this->baseUrl = $baseUrl;
	}
	
	public function getOnly( $sparseFieldsets = [] )
	{
		$this->sparseFieldsets = $sparseFieldsets;
		return $this;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getBaseUrl()
	{
		return $this->baseUrl;
	}

	public function toIdentifier()
	{
		$data = [];

		$this->entities->each( function( $key, $entity ) use( &$data ) {
			$entity = new $this->transformer( $entity, $this->getBaseUrl() );
			$data[] = $entity->toIdentifier(); 
		});

		return $data;
	}

	public function toResource()
	{
		$data = [];

		$this->entities->each( function( $key, $entity ) use( &$data ) {
			$transformer = new $this->transformer( $entity, $this->getBaseUrl() );
			$data[] = $transformer->getOnly( $this->sparseFieldsets )->toResource(); 
		});
		
		return $data;
	}

	public function getIncluded( $whatToInclude = '' )
	{
		
		$bag = new Bag();

		$this->entities->each( function( $key, $entity ) use( &$bag, $whatToInclude ) {
			$transformer = new $this->transformer( $entity, $this->getBaseUrl() );
			$bag->add( $transformer->getOnly( $this->sparseFieldsets )->getIncluded( $whatToInclude )); 
		});
		
		return $bag->toArray();
	}

}