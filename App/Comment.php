<?php  namespace App;

class Comment
{
	public $id, $title, $body;

	public function __construct( $id, $title, $body )
	{
		$this->id = $id;
		$this->title = $title;
		$this->body = $body;
	}
	
}