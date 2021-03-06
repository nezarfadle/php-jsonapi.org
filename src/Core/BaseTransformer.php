<?php namespace JsonApi\Core;

use JsonApi\Utils\Url,
	JsonApi\Utils\ArrayUtil,
	JsonApi\ValueObjects\StringValueObject,
	JsonApi\ValueObjects\ArrayValueObject,
	JsonApi\Collections\RelationshipCollection
;

abstract class BaseTransformer
{

	protected $baseUrl, $sparseFieldsets;

	abstract public function getId();
	abstract public function getType();
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

		return $this->getAttributes();
	}
	
	public function getMeta(){}
	public function getRelation(){ return []; }
	public function getExtra(){ return []; }

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

	public function getRelationships()
	{

		$relations = new RelationshipCollection( [ $this->getRelation() ] );
		$data = [];
		
		$relations->each( function( $key, $relation ) use( &$data ) {
			
			$transformer = $relation->createTransformer();
			$data[ $key ] = [
				'links' => [
					'self' => Url::build( [ $this->getBaseUrl(), $this->getType(), $this->getId(), 'relationships', $transformer->getType() ]),
					'related' => Url::build( [ $this->getBaseUrl(), $this->getType(), $this->getId(), $transformer->getType () ] )
				],
				'data' => $transformer->toIdentifier()
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

		$relations = new RelationshipCollection( [ $this->getRelation(), $this->getExtra() ] );
		$relations->each( function( $entityName, $relation ) use( &$bag, $fieldsToBeIncluded ) {
			
			if( $fieldsToBeIncluded->has( $entityName )) {
				$result = new Result( $relation->toResource( $this->sparseFieldsets ) );
				if( $result->hasContent() ) {
					$bag->add( $result->getContent() );
				}
			}

		});
		
		return $bag->toArray();
		 
	}

	
}