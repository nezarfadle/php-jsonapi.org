<?php namespace JsonApi;

class RelationshipEx
{
	private $participant, $resolver;

	public function __construct( $participant, $resolver )
	{
		$this->participant = $participant;
		$this->resolver = $resolver;
	}

	public function getParticipant()
	{
		return $this->participant;
	}

	public function getResolver()
	{
		return $this->resolver;
	}
	
}