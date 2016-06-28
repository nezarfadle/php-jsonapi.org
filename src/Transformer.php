<?php  namespace JsonApi;

abstract class Transformer
{
	
	protected $entity;

	public function __construct( $entity )
	{
		$this->entity = $entity;
	}

	public function getEntity()
	{
		return $this->entity;
	}

	public function getIdentifier()
	{
		return new ResourceIdentifier( $this->entity->getType() , $this->entity->getId() );
	}

	public function getAttributes()
	{
		return $this->entity->getAttributes();
	}

	public function getIdentity()
	{
		return $this->entity->getIdentity();
	}
	
}