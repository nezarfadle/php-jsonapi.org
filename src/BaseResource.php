<?php namespace JsonApi;

abstract class BaseResource
{
	protected $resourceIdentifier, $attributes = [], $relationships = [], $conf;

	public function __construct($conf)
	{
		$this->conf = $conf;
	}

	protected function hasFuture( $future ) 
	{
		return in_array( $future, $this->conf['features'] ) || array_key_exists( $future, $this->conf['features'] );	
	}

	protected function hasAttributes()
	{
		return $this->hasFuture( 'attributes' );
	}

	protected function hasRelationships()
	{
		return $this->hasFuture( 'relationships' );
	}

	protected function hasLinks()
	{
		return $this->hasFuture( 'links' );
	}

	protected function hasMeta()
	{
		return $this->hasFuture( 'meta' );
	}

	protected function hasJsonApi()
	{
		return $this->hasFuture( 'jsonapi' );
	}

	protected function getSchema()
	{

		$data = [];

		$data['type'] = $this->conf['main']->getIdentifier()->getType();
		$data['id'] = $this->conf['main']->getIdentifier()->getId();

		if( $this->hasAttributes() ) {
			$data['attributes'] = $this->conf['main']->getAttributes();
		}

		if ( $this->hasRelationships() ) {
			
			$data['relationships'] = [];
			
			foreach( $this->conf['features']['relationships'] as $relationshipName => $provider ) {
				// $data['relationships'][ $relationshipName ] = $provider->getRelationship(); 
				$data['relationships'][ $relationshipName ] = [
					'links' => [
						'self' => 'http://example.com/' . $data['type'] . '/1/relationships/' . $relationshipName,
						'related' => 'http://example.com/' . $data['type'] . '/1/' . $relationshipName
					],
					'data' => $provider->getData()
				];
			}
			
		}

		if ( $this->hasLinks() ) {
			// $data['links'] = $this->conf['main']->getLinks();
			$data['links'] = [ 'self' => 'http://example.com/' . $data['type'] . '/' . $data['id'] ];
		}

		if ( $this->hasMeta() ) {
			$data['meta'] = $this->conf['main']->getMeta();
		}

		if ( $this->hasJsonApi() ) {
			$data['jsonapi'] = [ 'version' => $this->conf['main']->getJsonApi() ];
		}

		

		return $data;

	}

}

