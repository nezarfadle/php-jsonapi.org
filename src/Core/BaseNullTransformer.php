<?php  namespace JsonApi\Core;

use JsonApi\Core\BaseTransformer
;

abstract class BaseNullTransformer extends BaseTransformer
{
	
	protected $type;

	public function __construct( $baseUrl, $type )
	{
		parent::__construct( $baseUrl );
		$this->type = $type;
	}

	public function getId(){}

	public function getType()
	{
		return $this->type;
	}
	
	public function getAttributes()
	{
		return [];
	}

	public function toResource()
	{
		return null;
	}
}