<?php  namespace JsonApi;

abstract class BaseProvider
{
	abstract function getRelationship();
	abstract function getIncluded();
}