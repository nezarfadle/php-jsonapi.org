<?php

include 'vendor/autoload.php';

use App\Article,
	App\Author,
	App\Comment,
	App\ArticleTransformer,
	App\ArticleCollectionTransformer,
	JsonApi\Bag

;

$op = isset($_GET['op']) ? $_GET['op'] : '';
$include = isset($_GET['include']) ? $_GET['include'] : '';
$baseUrl = 'http://awseome.com';

$sparseFieldsets = [
	"comments" => "body",
	"articles" => "body",
	"authors" => "email",
];

switch ($op) {
	case 'article':

		$article = App\Tasks\GetArticleTask::get( $baseUrl );

		$data  = [
			'data' => $article->getOnly( $sparseFieldsets )->toResource(),
			'included' => $article->getIncluded( $include )
		];
		echo '<pre>', json_encode( $data, JSON_PRETTY_PRINT);
		break;
	
	case 'articles':
	

		$articles = App\Tasks\GetAllArticlesTask::get( $baseUrl );
		$col = new ArticleCollectionTransformer( $articles, $baseUrl );
		$data = [
			"data" => $col->getOnly( $sparseFieldsets )->toResource(),
			"included" => $col->getIncluded( $include ),
		];

		echo '<pre>', json_encode( $data, JSON_PRETTY_PRINT);
		break;
}

// class Foo
// {
// 	public $id;
// 	public function __construct( $id )
// 	{
// 		$this->id = $id;
// 	}
// }

// $f1 = new Foo(1);
// $f2 = new Foo(2);

// echo spl_object_hash( $f1 ), '<br>';
// echo spl_object_hash( $f2 ), '<br>';