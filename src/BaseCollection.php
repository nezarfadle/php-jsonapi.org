<?php  namespace jsonApi;

abstract class BaseCollection
{
	private $type, $entites, $resolver, $baseUrl, $sparseFieldsets;

	public function __construct( $type, $entites, $resolverClassName, $baseUrl )
	{
		$this->type = $type;
		$this->entites = $entites;
		$this->resolver = $resolverClassName;
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

		foreach ( $this->entites as $entity ) {
			$entity = new $this->resolver( $entity, $this->getBaseUrl() );
			$data[] = $entity->toIdentifier(); 
		}
		return $data;
	}

	public function toResource()
	{
		$data = [];

		foreach ($this->entites as $entity) {
			$entity = new $this->resolver( $entity, $this->getBaseUrl() );
			$data[] = $entity->getOnly( $this->sparseFieldsets )->toResource(); 
		}
		return $data;
	}

}