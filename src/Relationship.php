<?php namespace JsonApi;

class Relationship
{
	private $participant, $resolver, $baseUrl;

	public function __construct( $participant, $resolver, $baseUrl )
	{
		$this->participant = $participant;
		$this->resolver = $resolver;
		$this->baseUrl = $baseUrl;
	}

	public function getParticipant()
	{
		return $this->participant;
	}

	public function getResolver()
	{
		return $this->resolver;
	}

	public function createResolver()
	{
		return new $this->resolver( $this->participant, $this->baseUrl );
	}
	
}