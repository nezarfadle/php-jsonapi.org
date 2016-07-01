<?php  namespace JsonApi;

class RelationshipResolver
{

	// public static function fromEntity( $parent, $entity )
	// {
	// 	return [
	// 		'links' => [
	// 			'self' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/relationships' . $entity->getType (),
	// 			'related' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/' . $entity->getType (),
	// 		],
	// 		'data' => $entity->toIdentifier()
	// 	];
	// }

	// public static function fromCollection( $parent, $childs, $collectionClassName )
	// {
	// 	$collection = new $collectionClassName( $childs );
	// 	return [
	// 		'links' => [
	// 			'self' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/relationships' . $collection->getType (),
	// 			'related' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/' . $collection->getType (),
	// 		],
	// 		'data' => $collection->getIdentifiers()
	// 	];
	// }

	public static function resolve( $parent, $childs, $collectionClassName )
	{
		$collection = new $collectionClassName( $childs );
		return [
			'links' => [
				'self' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/relationships' . $collection->getType (),
				'related' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/' . $collection->getType (),
			],
			'data' => $collection->toIdentifier()
		];
	}
	
}