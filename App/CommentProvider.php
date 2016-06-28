<?php namespace App;

use JsonApi\SingleResource,
	JsonApi\Links

;

class CommentProvider
{
	private $comments;

	public function __construct( $comments )
	{
		$this->comments = $comments;
	}

	public function getRelationship()
	{
		$data = [];
		
		foreach( $this->comments as $comment ) {
			$t = new CommentTransformer( $comment );
			$data[] = $t->getRelationship();
		}
		return $data;
	}

	public function getIncluded()
	{
		$data = []; 

		foreach( $this->comments as $comment ) {
			$r = new SingleResource([
				'main' => new CommentTransformer( $comment ),
				'features' => [ "attributes", "links" ]
			]);

			$data[] = $r->getSchema();
		}

		return $data;

	}
	
}