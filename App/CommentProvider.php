<?php namespace App;

use JsonApi\BaseProvider,
	JsonApi\Resource,
	JsonApi\Links

;

class CommentProvider extends BaseProvider
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
			$t = new CommentEntity( $comment );
			$data[] = $t->getIdentity();
		}
		return $data;
	}

	public function getIncluded()
	{
		$data = []; 

		foreach( $this->comments as $comment ) {
			$r = new Resource([
				'baseurl' => 'http://example.com/api/v1',
				'entity' => new CommentEntity( $comment ),
				'features' => [ "attributes", "links" ]
			]);

			$data[] = $r->getData();
		}

		return $data;

	}
	
}