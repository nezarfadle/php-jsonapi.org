<?php namespace JsonApi\Core;

class Relationship
{
	private $entity, $resolver, $baseUrl;

	public function __construct( $entity, $resolver, $baseUrl )
	{
		$this->entity = $entity;
		$this->resolver = $resolver;
		$this->baseUrl = $baseUrl;
	}

	public function getParticipant()
	{
		return $this->entity;
	}

	public function getResolver()
	{
		return $this->resolver;
	}

	public function createResolver()
	{
		return new $this->resolver( $this->entity, $this->baseUrl );
	}

	public function toResource( $sparseFieldsets = [] )
	{
		$resource = new $this->resolver( $this->entity, $this->baseUrl );
		return $resource->getOnly( $sparseFieldsets )->toResource();
	}
	
}