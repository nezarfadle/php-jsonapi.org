<?php namespace App;

use JsonApi\Transformer
;

class CommentTransformer extends Transformer
{

	public function __construct( $comment )
	{
		parent::__construct( new CommentEntity( $comment ) );
	}

}