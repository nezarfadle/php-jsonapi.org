<?php  namespace App;

use JsonApi\BaseCollection;

class ArticleCollectionTransformer extends BaseCollection
{

	public function __construct( $articles, $baseUrl )
	{
		parent::__construct( 'articles', $articles, 'App\ArticleTransformer', $baseUrl );
	}
	
}