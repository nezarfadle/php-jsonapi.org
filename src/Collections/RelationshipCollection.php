<?php  namespace JsonApi\Collections;

class RelationshipCollection extends ArrayCollection
{

	public function __construct( $relations )
	{
		parent::__construct( $relations );
	}
	
}