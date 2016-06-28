<?php  namespace App;

class Comment
{
	public $id, $title, $body, $author;

	public function __construct( $id, $title, $body )
	// public function __construct( $id, $title, $body, $author )
	{
		$this->id = $id;
		$this->title = $title;
		$this->body = $body;
		// $this->author = $author;
	}
	
}