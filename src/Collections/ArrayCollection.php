<?php namespace JsonApi\Collections;

abstract class ArrayCollection
{
	private $array ;

	public function __construct( $array )
	{
		$this->array = $array;
	}

	public function each( $cb )
	{
		foreach ( $this->array as $key => $o ) {
			$cb( $key, $o );
		}
	}
	
}