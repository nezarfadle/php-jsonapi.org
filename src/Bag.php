<?php  namespace JsonApi;

class Bag
{

	private $bag = [];

	public function fromEntity( $entity )
	{
		$this->bag[] = $entity->toResource();
	}

	public function fromCollection( $entities, $collectionClassname )
	{
		
		$collection = new $collectionClassname( $entities );
		self::addItems( $collection->getResources() );
		
	}

	public function resolve( $entity, $resolver )
	{
		
		$re = new $resolver( $entity );
		self::add( $re->toResource() );
		
	}

	public function addItem( $item )
	{
		$this->bag[] = $item;
	}

	public function addItems( $items )
	{
		$this->bag = array_merge( $this->bag, $items );
	}

	public function add( $items )
	{

		if( !array_key_exists( 'type', $items ) )  {
			self::addItems( $items );
		} else {
			self::addItem( $items );
		}
		
	}

	public function getItem( $index )
	{
		return $this->bag[ $index ];
	}

	public function getAll()
	{
		return $this->bag;
	}


}