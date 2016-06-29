<?php  namespace JsonApi;

interface Collection
{

	abstract public function getType();
	abstract public function getIdentifiers();
	abstract public function getResources();
	
}