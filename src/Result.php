<?php namespace JsonApi;

class Result
{
	private $result;

	public function __construct( $result )
	{
		$this->result = $result;
	}

	public function hasContent()
	{
		return !empty( $this->result );
	}

	public function getContent()
	{
		return $this->result;
	}
	
}