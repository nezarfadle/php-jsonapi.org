<?php  namespace jsonApi;

abstract class BaseCollection
{
	private $type, $entites, $resolver, $baseUrl, $sparseFieldsets;

	public function __construct( $type, $entites, $resolverClassName, $baseUrl, $sparseFieldsets = [] )
	{
		$this->type = $type;
		$this->entites = $entites;
		$this->resolver = $resolverClassName;
		$this->baseUrl = $baseUrl;
		$this->sparseFieldsets = $sparseFieldsets;
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
			$entity = new $this->resolver( $entity, $this->getBaseUrl(), $this->sparseFieldsets );
			$data[] = $entity->toResource(); 
		}
		return $data;
	}

}