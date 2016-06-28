<?php  namespace JsonApi;

abstract class BaseProvider
{
	protected $transformer, $entity;

	public function __construct( $entity, $transformer )
	{
		$this->entity = $entity;
		$this->transformer = $transformer;
	}

}