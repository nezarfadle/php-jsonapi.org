<?php namespace Test\Models;

class Article
{

	public $id, $title, $body, $author, $comments = [] ;
	private $commentsAuthors = [];

	public function __construct( $id, $title, $body, $author )
	{
		$this->id = $id;
		$this->title = $title;
		$this->body = $body;
		$this->author = $author;
	}
	

	public function has($comment)
	{
		$this->comments[] = $comment;
		$this->commentsAuthors[] = $comment->author;
	}


	public function getCommentsAuthors()
	{
		return $this->commentsAuthors;
	}
}
