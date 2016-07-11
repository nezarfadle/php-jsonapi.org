<?php  namespace JsonApi;

class EntitiesCollection extends ArrayCollection
{

	public function __construct( $entities )
	{
		parent::__construct( $entities );
	}
	
}