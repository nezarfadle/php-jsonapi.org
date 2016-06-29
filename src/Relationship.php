<?php  namespace JsonApi;

class Relationship
{

	public function __construct( $name, $links, $data )
	{
		return [
			$name = [
				'links' => $links,
				'data' => $data
			]
		];
	}

	public static function fromEntity( $parent, $entity )
	{
		return [
			'links' => [
				'self' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/relationships' . $entity->getType (),
				'related' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/' . $entity->getType (),
			],
			'data' => $entity->toIdentifier()
		];
	}

	public static function fromCollection( $parent, $collection )
	{
		return [
			'links' => [
				'self' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/relationships' . $collection->getType (),
				'related' => 'http://exmaople.com/' . $parent->getType() . '/' . $parent->getId() . '/' . $collection->getType (),
			],
			'data' => $collection->getIdentifiers()
		];
	}
	
}