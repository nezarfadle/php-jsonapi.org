<?php  namespace App;

use JsonApi\BaseCollectionTransformer;

class ArticleCollectionTransformer extends BaseCollectionTransformer
{

	public function __construct( $articles, $baseUrl )
	{
		parent::__construct( 'articles', $articles, 'App\ArticleTransformer', $baseUrl );
	}
	
}