<?php namespace JsonApi;

abstract class BaseEntity
{

	abstract public function getId();
	abstract public function getType();
	abstract public function toRaw();	
	abstract public function getAttributes();
	abstract public function getLinks();
	
	public function getRelationships(){}
	public function getMeta(){}

	public function toIdentifier()
	{
		return [
			"type" => $this->getType(), 
			"id" => (string) $this->getId()
		];
	}

	public function toResource()
	{
		$data = [
			"type" => $this->getType(), 
			"id" => (string) $this->getId(),
			'attributes' => [
				$this->getAttributes()
			]
		];

		$relationships = $this->getRelationships();

		if( !empty( $relationships )) {
			$data['relationships'] = $relationships;
		}

		$meta = $this->getMeta();

		if( !empty( $meta )) {
			$data['meta'] = $meta;
		}

		return $data;
	}

	

	
}