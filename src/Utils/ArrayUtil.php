<?php  namespace JsonApi\Utils;

class ArrayUtil
{

	public function explode()
	{
		
	}

	public static function isEmpty( $array )
	{
		if( !is_array( $array ) || count( $array ) == 0 ) {
			return true;
		}

		return false;
	}

	public static function spliceByKeys( $delimiter, $string, $array)
	{
		$data = [];

		$fields = explode( $delimiter, $string );

		foreach( $fields as $field ) {
			if( isset( $array[$field] ) && $array[$field] !== null ) {
				$data[$field] = $array[$field];
			} 
		}

		return $data;
	}
}