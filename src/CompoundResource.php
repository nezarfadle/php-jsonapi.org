<?php namespace JsonApi;



class CompoundResource extends BaseResource
{
	private $includes = [] ;

	

	protected function hasIncluded()
	{
		// return (isset( $this->conf['included'] ) && !empty( $this->conf['included'] )) && $this->hasRelationships();
		return $this->hasFuture( 'included' ) && $this->hasRelationships();
	}

	public function include( SingleResource $resource )
	{
		$this->includes[] = $resource;
	}

	public function getSchema()
	{

		$data = parent::getSchema();

		

		if ( !$this->hasIncluded() ) {
			return $data;	
		}

		$data['included'] = [];
			
		// foreach( $this->conf['features']['included'] as $provider ) {
		foreach( $this->conf['features']['included'] as $providerName ) {
			
			// $buffer = $provider->getIncluded();
			$buffer = $this->conf['features']['relationships'][ $providerName ]->getIncluded();
			
			foreach( $buffer as $resource ) {
				$data['included'][] = $resource;
			}
		}

		return $data;
	}


}