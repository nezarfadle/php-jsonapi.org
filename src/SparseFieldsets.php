<?php namespace JsonApi;

class SparseFieldsets
{

	priavte $sparseFieldsets;

	public function __construct( $sparseFieldsets = [] )
	{
		$this->sparseFieldsets = $sparseFieldsets;
	}

	public function has( $fieldName )
	{
		if( !isset( $this->sparseFieldsets[ $fieldName ] ) || null === $this->sparseFieldsets[ $fieldName ] ) {
			return false;
		}

		return true;
	}
	
}