<?php  namespace JsonApi\Utils;

class Url
{
	public static function build( $urlSegments  )
	{
		return implode( '/', $urlSegments );
	}
}