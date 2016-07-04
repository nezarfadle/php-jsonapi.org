<?php  namespace JsonApi;

use JsonApi\Utils\Url;

class RelationshipResolver
{

	public static function resolve( $parent, $childs, $resolverClassName, $baseUrl )
	{
		$resolver = new $resolverClassName( $childs, $baseUrl );
		return [
			'links' => [
				'self' => Url::build( [ $baseUrl, $parent->getType(), $parent->getId(), 'relationships', $resolver->getType () ]),
				'related' => Url::build( [ $baseUrl, $parent->getType(), $parent->getId(), $resolver->getType () ] )
			],
			'data' => $resolver->toIdentifier()
		];
	}
	
}