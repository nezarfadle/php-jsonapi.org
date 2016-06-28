<?php namespace App;

class Article
{

	public $id, $title, $body, $author, $comments = [] ;

	public function __construct( $id, $title, $body )
	{
		$this->id = $id;
		$this->title = $title;
		$this->body = $body;
	}
	
	public function writtenBy($author)
	{
		$this->author = $author;
	}

	public function has($comment)
	{
		$this->comments[] = $comment;
	}
}
