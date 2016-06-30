<?php  namespace JsonApi;

interface ICollection
{

	abstract public function getType();
	abstract public function getIdentifiers();
	abstract public function getResources();
	
}