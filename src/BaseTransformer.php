<?php namespace JsonApi;

use JsonApi\Utils\Url,
	JsonApi\Utils\ArrayUtil,
	JsonApi\ValueObjects\StringValueObject,
	JsonApi\ValueObjects\ArrayValueObject
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
	

	protected function hasSparseFieldsets()
	{
		return isset( $this->sparseFieldsets[ $this->getType() ] );
	}

	protected function hasRelationships()
	{
		return count( $this->getRelationships() );
	}

	protected function hasMeta()
	{
		return count( $this->getMeta() );
	}

	protected function resolveSparseFieldsets()
	{
		
		if( $this->hasSparseFieldsets() ) {
			return ArrayUtil::spliceByKeys( $this->sparseFieldsets[ $this->getType() ], $this->getAttributes() );
		}

		// return $attrs;
		return $this->getAttributes();
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

		if( $this->hasRelationships() ) {
			$data['relationships'] = $this->getRelationships();
		}

		/**
		 * build the resource links
		 */
		$data['links'] = $this->getLinks();

		/**
		 * build the resource meta
		 */
		if( $this->hasMeta() ) {
			$data['meta'] = $this->getMeta();
		}

		return $data;
	}

	public function getIncluded( $whatToInclude = '' )
	{
		
		$whatToInclude = new StringValueObject( $whatToInclude );
		$fieldsToBeIncluded = $whatToInclude->toArrayValueObject();

		if( $fieldsToBeIncluded->isEmpty() ) return ;

	
		$bag = new Bag();		

		$relations = new RelationshipCollection( $this->getRelation() );
		$relations->each( function( $entityName, $relation ) use( &$bag, $fieldsToBeIncluded ) {
			
			if( $fieldsToBeIncluded->has( $entityName ))
			{
				$bag->add( $relation->toResource( $this->sparseFieldsets ));
			}

		});
		
		$extraRelations = new RelationshipCollection( $this->getExtra() );
		$extraRelations->each( function( $entityName, $relation ) use( &$bag, $fieldsToBeIncluded ) {
			if( $fieldsToBeIncluded->has( $entityName ))
			{
				$bag->add( $relation->toResource( $this->sparseFieldsets ));
			}
		});
		
		return $bag->toArray();
	}

	
}