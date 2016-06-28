<?php namespace JsonApi;

class Attributes
{
	private $attributes ;

	public function set( $name, $attribute )
	{
		$this->attributes[ $name ] = $attribute ;
		return $this;
	}

	public function get()
	{
		return $this->attributes;
	}
}