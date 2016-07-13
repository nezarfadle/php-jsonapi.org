<?php  namespace JsonApi\Utils;

class ArrayUtil
{

	public static function merge( $arrays = [] )
	{
		$buffer = [];

		foreach ( $arrays as $array) {

			if( !ArrayUtil::isEmpty( $array )) {
				$buffer = array_merge( $buffer, $array );
			}
		}

		return $buffer;
	}

	public function arrayValues( $array = [] )
	{
		return array_values( $array );
	}

	public static function isEmpty( $array )
	{
		if( !is_array( $array ) || count( $array ) == 0 ) {
			return true;
		}

		return false;
	}

	public static function spliceByKeys( $string, $array, $delimiter = ',' )
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