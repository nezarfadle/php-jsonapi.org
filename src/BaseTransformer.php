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
	
	
	public function __construct( $baseUrl, $sparseFieldsets = [] )
	{
		$this->baseUrl = $baseUrl;	
		$this->sparseFieldsets = $sparseFieldsets;
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

	// protected function resolveSparseFieldsets( $attrs, $sparseFieldsets = '' )
	protected function resolveSparseFieldsets( $attrs )
	{
		// $sparseFieldsets = new StringValueObject( $sparseFieldsets );
		// if( $sparseFieldsets->isEmpty() ) return $attrs;
		
		// return ArrayUtil::spliceByKeys( ',', $sparseFieldsets, $attrs );
		
		if( isset( $this->sparseFieldsets[ $this->getType() ] )) {
			return ArrayUtil::spliceByKeys( ',', $this->sparseFieldsets[ $this->getType() ], $attrs );
		}

		return $attrs;

		// [
		// 	"articles" => [ "title,body" ]
		// ]
	}

	public function toResource()
	{
		$data = [
			"type" => $this->getType(), 
			"id" => (string) $this->getId(),
			'attributes' => 
				// $this->getAttributes()
				// $this->resolveSparseFieldsets( $this->getAttributes(), $this->sparseFieldsets )
				$this->resolveSparseFieldsets( $this->getAttributes() )
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

	public function getRelation()
	{
		return [];	
	}

	public function getRelationships()
	{

		$relations = $this->getRelation();
		$data = [];
		foreach($relations as $key => $relation) 
		{
			// $data[ $key ] = RelationshipResolver::resolve( $this, $relation->getParticipant(), $relation->getResolver(), $this->getBaseUrl() );
			$resolver = $relation->createResolver();
			
			$data[ $key ] = [
				'links' => [
					'self' => Url::build( [ $this->getBaseUrl(), $this->getType(), $this->getId(), 'relationships', $resolver->getType() ]),
					'related' => Url::build( [ $this->getBaseUrl(), $this->getType(), $this->getId(), $resolver->getType () ] )
				],
				'data' => $resolver->toIdentifier()
			];
		}
		
		return $data;
	}

	public function getExtra()
	{
		return [];
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
				$bag->resolve( $relation->getParticipant(), $relation->getResolver(), $this->sparseFieldsets );
			}
		}

		$extraRelations = $this->getExtra();
		foreach($extraRelations as $key => $relation) 
		{
			if(in_array( $key, $list ))
			{
				$bag->resolve( $relation->getParticipant(), $relation->getResolver(), $this->sparseFieldsets );
			}
		}
			
		return $bag->getAll();
	}

	
}