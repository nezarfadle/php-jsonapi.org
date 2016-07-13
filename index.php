<?php

include 'vendor/autoload.php';

use App\Article,
	App\Author,
	App\Comment,
	App\ArticleTransformer,
	App\ArticleCollectionTransformer,
	JsonApi\Core\Bag

;

$op = isset($_GET['op']) ? $_GET['op'] : '';
$include = isset($_GET['include']) ? $_GET['include'] : '';
$baseUrl = 'http://awesome.com';

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
		$data = [
			"data" => $articles->getOnly( $sparseFieldsets )->toResource(),
			"included" => $articles->getIncluded( $include ),
		];

		echo '<pre>', json_encode( $data, JSON_PRETTY_PRINT);
		break;
}