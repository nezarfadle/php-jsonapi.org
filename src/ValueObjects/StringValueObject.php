<?php  namespace JsonApi\ValueObjects;

class StringValueObject
{

	private $string;

	public function __construct( $string )
	{
		$this->string = $string;
	}

	public function isEmpty()
	{
		if( trim( $this->string === '' )) {
			return true;
		}

		return false;
	}

	public function __toString()
	{
		return $this->string;
	}

	public function toArray( $delimiter )
	{
		return explode( $delimiter, $this->string );
	}
	
}