<?php namespace JsonApi;

use JsonApi\Utils\Url,
	JsonApi\Utils\ArrayUtil,
	JsonApi\ValueObjects\StringValueObject
;

abstract class BaseTransformer
{

	protected $baseUrl, $sparseFieldsets;

	abstract public function getId();
	abstract public function getType();
	abstract public function toRaw();	
	abstract public function getAttributes();
	
	
	public function __construct( $baseUrl )
	{
		$this->baseUrl = $baseUrl;	
	}
	
	public function getMeta(){}

	public function getBaseUrl()
	{
		return $this->baseUrl;
	}

	public function getLinks()
	{
		return [
			'self' => Url::build( [ $this->getBaseUrl(), $this->getType(), $this->getId() ] )
		];
	}

	public function toIdentifier()
	{
		return [
			"type" => $this->getType(), 
			"id" => (string) $this->getId()
		];
	}

	public function getOnly( $sparseFieldsets = [] )
	{
		$this->sparseFieldsets = $sparseFieldsets;
		return $this;
	}

	protected function hasSparseFieldsets()
	{
		return isset( $this->sparseFieldsets[ $this->getType() ] );
	}

	protected function resolveSparseFieldsets()
	{
		
		if( $this->hasSparseFieldsets() ) {
			return ArrayUtil::spliceByKeys( $this->sparseFieldsets[ $this->getType() ], $this->getAttributes() );
		}

		return $attrs;
	}

	public function getRelation()
	{
		return [];	
	}

	public function getExtra()
	{
		return [];
	}

	public function getRelationships()
	{

		
		$relations = new RelationshipCollection( $this->getRelation() );
		$data = [];
		
		$relations->each( function( $key, $relation ) use( &$data ) {
			
			$resolver = $relation->createResolver();			
			$data[ $key ] = [
				'links' => [
					'self' => Url::build( [ $this->getBaseUrl(), $this->getType(), $this->getId(), 'relationships', $resolver->getType() ]),
					'related' => Url::build( [ $this->getBaseUrl(), $this->getType(), $this->getId(), $resolver->getType () ] )
				],
				'data' => $resolver->toIdentifier()
			];

		});
		
		return $data;
	}

	public function toResource()
	{
		$data = [
			"type" => $this->getType(), 
			"id" => (string) $this->getId(),
			'attributes' => $this->resolveSparseFieldsets()
		];

		$relationships = $this->getRelationships();
		if( !empty( $relationships )) {
			$data['relationships'] = $relationships;
		}

		/**
		 * build the resource links
		 */
		$data['links'] = $this->getLinks();

		/**
		 * build the resource meta
		 */
		$meta = $this->getMeta();
		if( !empty( $meta )) {
			$data['meta'] = $meta;
		}

		return $data;
	}

	public function getIncluded( $whatToInclude = '' )
	{
		// if( $whatToInclude == '' ) return ;

		$list = explode( ',', $whatToInclude);
		if( ArrayUtil::isEmpty( $list ) ) return ;

		$bag = new Bag( $this->getBaseUrl() );

		$relations = $this->getRelation();
		foreach($relations as $key => $relation) 
		{
			if(in_array( $key, $list ))
			{
				$bag->add( $relation->toResource( $this->sparseFieldsets ));
			}
		}

		$extraRelations = $this->getExtra();
		foreach($extraRelations as $key => $relation) 
		{
			if(in_array( $key, $list ))
			{
				$bag->add( $relation->toResource( $this->sparseFieldsets ));
			}
		}
			
		return $bag->getAll();
	}

	
}