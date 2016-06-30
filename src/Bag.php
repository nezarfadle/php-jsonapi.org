<?php  namespace JsonApi;

class Bag
{

	private static $bag = [];

	public static function fromEntity( $entity )
	{
		self::$bag[] = $entity->toResource();
	}

	public static function fromCollection( $entities, $collectionClassname )
	{
		
		$collection = new $collectionClassname( $entities );
		self::addItems( $collection->getResources() );
		
	}

	public static function addItem( $item )
	{
		self::$bag[] = $item;
	}

	public static function addItems( $items )
	{
		self::$bag = array_merge( self::$bag, $items );
	}

	public static function getItem( $index )
	{
		return self::$bag[ $index ];
	}

	public static function getAll()
	{
		return self::$bag;
	}


}