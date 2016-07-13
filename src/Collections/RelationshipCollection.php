<?php  namespace JsonApi\Collections;

use JsonApi\Utils\ArrayUtil;

class RelationshipCollection extends ArrayCollection
{

	public function __construct( $relations = [] )
	{
		parent::__construct( ArrayUtil::merge( $relations ));
	}
	
}