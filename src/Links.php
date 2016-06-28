<?php namespace JsonApi;

class Links
{
	private $links ;

	public function set( $name, $url )
	{
		$this->links[ $name ] = $url ;
		return $this;
	}

	public function get()
	{
		return $this->links;
	}
}