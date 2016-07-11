<?php  namespace JsonApi;

class Bag
{

	private $baseUrl;

	public function __construct( $baseUrl )
	{
		$this->baseUrl = $baseUrl;
	}

	private $bag = [];

	// public function resolve( $entity, $resolver, $sparseFieldsets = [] )
	// {
	// 	$resource = new $resolver( $entity, $this->baseUrl );
	// 	$this->add( $resource->getOnly( $sparseFieldsets )->toResource() );
	// }

	private function hash( $obj )
	{
		// return spl_object_hash( (object)$obj );
		return $obj['id'].$obj['type'];
		// print_r($obj);
	}

	private function addItem( $item )
	{
		$this->bag[ $this->hash($item) ] = $item;
	}

	private function addItems( $items )
	{
		foreach($items as $item) {
			$this->addItem( $item );
		}
		// $this->bag = array_merge( $this->bag, $items );
	}

	public function add( $items )
	{

		if( !array_key_exists( 'type', $items ) )  {
			$this->addItems( $items );
		} else {
			$this->addItem( $items );
		}
		
	}

	public function getItem( $index )
	{
		return $this->bag[ $index ];
	}

	public function getAll()
	{
		return array_values( $this->bag );
	}


}