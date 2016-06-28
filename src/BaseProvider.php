<?php  namespace JsonApi;

abstract class BaseProvider
{
	// protected $transformer, $entity;

	// public function __construct( $entity, $transformer )
	// // public function __construct( $entity )
	// {
	// 	$this->entity = $entity;
	// 	$this->transformer = $transformer;
	// }

	abstract function getRelationship();
	abstract function getIncluded();

}