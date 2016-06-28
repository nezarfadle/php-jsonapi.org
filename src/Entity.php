<?php namespace JsonApi;

abstract class Entity
{

	abstract public function getId();
	abstract public function getType();
	abstract public function getAttributes();
	abstract public function toRaw();	
	
	public function getIdentity()
	{
		return [
			"type" => $this->getType(), 
			"id" => (string) $this->getId()
		];
	}



	public function getIdentifier()
	{
		return new ResourceIdentifier( $this->getType(), $this->getId() );
	}
	
	public function getMeta(){}
	public function getJsonApi(){}
	
}