<?php namespace App;

use JsonApi\Transformer
;


class CommentTransformer extends Transformer
{
	// private $comment;

	public function __construct( $comment )
	{
		// $this->comment = $comment ;
		parent::__construct( new AuthorEntity( $author ) );
	}
	
	// public function getIdentifier()
	// {
	// 	return new ResourceIdentifier( 'comments' , $this->comment->id );
	// }

	// public function getAttributes()
	// {
	// 	$attributes = new Attributes();
	// 	$attributes->set( "title", $this->comment->title )->set( "body", $this->comment->body );
	// 	return $attributes->get();
	// }

	// public function getLinks()
	// {
	// 	return [
	// 		"self" => "http://exmaple.com/api/v1"
	// 	];
	// }
	
	// public function getRelationship()
	// {

	// 	$links = new Links();
	// 	$links->set('self', 'http')->set('related', 'ftp');

	// 	return [
	// 		'links' => $links->get(),
	// 		"data" => [
	// 			"type" => "comments", 
	// 			"id" => (string) $this->comment->id
	// 		]
	// 	];
	// }

}