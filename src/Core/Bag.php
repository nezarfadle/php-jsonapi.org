<?php namespace JsonApi\Core;

class Bag
{

	private $bag = [];

	private function hash( $obj )
	{
		return md5( serialize( $obj ));
	}

	private function addItem( $item )
	{
		$this->bag[ $this->hash($item) ] = $item;
	}

	private function addItems( $items )
	{
		foreach( $items as $item ) {
			$this->addItem( $item );
		}
	}

	public function add( $items )
	{
		if( isset( $items[0] ) && is_array( $items[0] ) )  {
			$this->addItems( $items );
		} else {
			$this->addItem( $items );
		}	
	}

	public function toArray()
	{
		return array_values( $this->bag );
	}


}