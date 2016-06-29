<?php namespace JsonApi;

abstract class BaseResource
{
	// protected $resourceIdentifier, $attributes = [], $relationships = [], $conf;
	protected $conf, $baseurl;

	public function __construct($conf)
	{
		$this->conf = $conf;

		if( $this->hasBaseurl() )
		{
			$this->baseurl = $this->getOption('baseurl');
		}
	}

	protected function hasOption( $option ) 
	{
		return array_key_exists( $option, $this->conf );	
	}

	protected function hasFuture( $future ) 
	{
		return in_array( $future, $this->conf['features'] ) || array_key_exists( $future, $this->conf['features'] );	
	}

	protected function getOption( $option ) 
	{
		return $this->conf[ $option ];
	}

	protected function getFeature( $feature ) 
	{
		return $this->conf['features'][ $feature ];
	}

	protected function hasBaseurl()
	{
		return $this->hasOption( 'baseurl' );
	}

	protected function hasAttributes()
	{
		return $this->hasFuture( 'attributes' );
	}

	protected function hasRelationships()
	{
		return $this->hasFuture( 'relationships' );
	}

	protected function hasIncluded()
	{
		return $this->hasFuture( 'included' ) && $this->hasRelationships();
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

	public function getData()
	{

		$data = [];

		$data['type'] = $this->getOption('entity')->getType();
		$data['id'] = $this->getOption('entity')->getId();

		if( $this->hasAttributes() ) {
			$data['attributes'] = $this->getOption('entity')->getAttributes();
		}

		if ( $this->hasRelationships() ) {
			
			$data['relationships'] = [];
			$relatioships = $this->getFeature('relationships');

			foreach( $relatioships as $relationshipName => $provider ) {

				$data['relationships'][ $relationshipName ] = [
					'links' => [
						'self' => $this->baseurl . '/' . $data['type'] . '/1/relationships/' . $relationshipName,
						'related' => $this->baseurl . '/' . $data['type'] . '/1/' . $relationshipName
					],
					'data' => $provider->getRelationship()
				];
			}
			
		}

		
		if ( $this->hasLinks() ) {
			$data['links'] = [ 'self' => $this->baseurl . '/' . $data['type'] . '/' . $data['id'] ];
		}

		if ( $this->hasMeta() ) {
			$data['meta'] = $this->getOption('entity')->getMeta();
		}

		return $data;

	}

	public function getIncluded()
	{
		if ( $this->hasIncluded() ) {
			
			$data = [];

			$providers = $this->getFeature('included') ;
			foreach( $providers as $providerName ) {
			
				$buffer = $this->getFeature('relationships')[ $providerName ]->getIncluded();
				
				foreach( $buffer as $resource ) {
					$data[] = $resource;
				}
			}

			return $data;
		}

	}

}

