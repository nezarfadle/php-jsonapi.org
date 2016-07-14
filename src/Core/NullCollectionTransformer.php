<?php  namespace JsonApi\Core;


class NullCollectionTransformer extends BaseNullTransformer
{

	public function __construct( $baseUrl, $type )
	{
		parent::__construct( $baseUrl, $type );
	}

	public function toIdentifier()
	{
		return [];
	}

}