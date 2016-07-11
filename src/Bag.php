<?php  namespace JsonApi;

class Bag
{

	private $bag = [];

	private function hash( $obj )
	{
		// return $obj['id'].$obj['type'];
		return md5( serialize( $obj ));
		// return json_encode( $obj );
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
	}

	public function add( $items )
	{
		// if( !array_key_exists( 'type', $items ) )  {
		if( isset( $items[0] ) && is_array( $items[0] ) )  {
			$this->addItems( $items );
		} else {
			$this->addItem( $items );
		}
		
	}

	public function getItem( $index )
	{
		return $this->bag[ $index ];
	}

	public function toArray()
	{
		return array_values( $this->bag );
	}


}