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

	public static function resolve( $entity, $resolver )
	{
		
		$re = new $resolver( $entity );
		self::add( $re->toResource() );
		
	}

	public static function addItem( $item )
	{
		self::$bag[] = $item;
	}

	public static function addItems( $items )
	{
		self::$bag = array_merge( self::$bag, $items );
	}

	public static function add( $items )
	{

		if( !array_key_exists( 'type', $items ) )  {
			self::addItems( $items );
		} else {
			self::addItem( $items );
		}
		
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