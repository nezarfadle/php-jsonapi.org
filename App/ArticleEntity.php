<?php  namespace App;

use JsonApi\BaseEntity,
	JsonApi\Relationship,	
	JsonApi\RelationshipEx,	
	JsonApi\Bag
;

class ArticleEntity extends BaseEntity
{
	private $article;

	public function __construct( $article )
	{
		$this->article  = $article;
	}
	
	public function getId()
	{
		return $this->article->id;
	}

	public function getType()
	{
		return 'articles';
	}

	public function toRaw()
	{
		return $this->article;
	}

	public function getAttributes()
	{
		return [
			'title' => $this->article->title,
			'body' => $this->article->body,
		];
	}

	public function getLinks()
	{
		return [
			'self' => 'http://exmaple.com/articles/' . $this->article->id
		];
	}

	public function setRelation()
	{
		return [
			'author' => new RelationshipEx( $this->article->author, 'App\AuthorEntity' ),
			'comments' => new RelationshipEx( $this->article->comments, 'App\CommentsCollection' ),
		];
	}
	
}