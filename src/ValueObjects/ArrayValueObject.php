<?php  namespace JsonApi\ValueObjects;

class ArrayValueObject
{
	private $array;

	public function __construct( $array )
	{
		$this->array = $array;
	}
	
	public function isEmpty()
	{
		if( !is_array( $this->array ) || count( $this->array ) == 0 ) {
			return true;
		}

		return false;
	}

	public function has( $value )
	{
		return in_array( $value, $this->array );
	}
}