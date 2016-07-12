<?php namespace App;

class Article
{

	public $id, $title, $body, $author, $comments = [] ;
	private $commentsAuthors = [];

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
		$this->commentsAuthors[] = $comment->author;
	}

	public function getComments()
	{
		// if( empty($this->comments)) {
		// 	return ;
		// }

		return $this->comments;
	}

	public function getCommentsAuthors()
	{
		return $this->commentsAuthors;
	}
}
