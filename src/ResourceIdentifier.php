<?php namespace JsonApi;

class ResourceIdentifier
{
	private $type, $id;

	public function __construct($type, $id)
	{
		$this->type = $type;
		$this->id = $id;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getId()
	{
		return $this->id;
	}
	
}