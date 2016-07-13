<?php  namespace App;

use JsonApi\Core\BaseTransformer,
	JsonApi\Core\Relationship,
	JsonApi\Core\Bag
;

class ArticleTransformer extends BaseTransformer
{
	private $article;

	public function __construct( $article, $baseUrl, $sparseFieldsets = [] )
	{
		parent::__construct( $baseUrl, $sparseFieldsets );
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

	public function getRelation()
	{
		return [
			'authors' => new Relationship( $this->article->author, 'App\AuthorEntity', $this->getBaseUrl() ),
			'comments' => new Relationship( $this->article->getComments(), 'App\CommentsCollection', $this->getBaseUrl() )
		];
	}

	public function getExtra()
	{
		return [
			'comments.authors' => new Relationship( $this->article->getCommentsAuthors(), 'App\AuthorasCollection', $this->getBaseUrl() ),
		];
	}

}