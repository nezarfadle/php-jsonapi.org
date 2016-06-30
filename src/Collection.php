<?php  namespace jsonApi;

abstract class Collection
{
	private $entites, $resolver;

	public function __construct( $entites, $resolverClassName )
	{
		$this->entites = $entites;
		$this->resolver = $resolverClassName;
	}
	
	abstract public function getType();


	public function toIdentifier()
	{
		$data = [];

		foreach ( $this->entites as $entity ) {
			$entity = new $this->resolver( $entity );
			$data[] = $entity->toIdentifier(); 
		}
		return $data;
	}

	public function toResource()
	{
		$data = [];

		foreach ($this->entites as $entity) {
			$entity = new $this->resolver( $entity );
			$data[] = $entity->toResource(); 
		}
		return $data;
	}

}