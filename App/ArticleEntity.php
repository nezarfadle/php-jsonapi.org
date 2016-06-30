<?php  namespace App;

use JsonApi\BaseEntity,
	JsonApi\Relationship,	
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
	public function getRelationships()
	{
		return [
			// 'author' => Relationship::fromEntity( $this, new AuthorEntity( $this->article->author )),
			'comments' => Relationship::fromCollection( $this, $this->article->comments, 'App\CommentsCollection' )
		];
	}

	public function getIncluded()
	{
		
		
		Bag::fromEntity( $this );
		Bag::fromCollection( $this->article->comments, 'App\CommentsCollection' );
		return Bag::getAll();
	}
}