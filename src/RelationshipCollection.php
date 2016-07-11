<?php  namespace JsonApi;

class RelationshipCollection extends ArrayCollection
{

	public function __construct( $relations )
	{
		parent::__construct( $relations );
	}
	
}