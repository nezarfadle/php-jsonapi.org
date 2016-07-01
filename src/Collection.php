<?php  namespace jsonApi;

abstract class Collection
{
	private $type, $entites, $resolver;

	public function __construct( $type, $entites, $resolverClassName )
	{
		$this->type = $type;
		$this->entites = $entites;
		$this->resolver = $resolverClassName;
	}
	
	public function getType()
	{
		return $this->type;
	}

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