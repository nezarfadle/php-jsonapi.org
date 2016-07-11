<?php

include 'vendor/autoload.php';

use App\Article,
	App\Author,
	App\Comment,
	App\ArticleTransformer,
	JsonApi\Bag

;

$op = isset($_GET['op']) ? $_GET['op'] : '';
$include = isset($_GET['include']) ? $_GET['include'] : '';
$baseUrl = 'http://awseome.com';

$sparseFieldsets = [
	"comments" => "title",
	"articles" => "body",
	"authors" => "email",
];

switch ($op) {
	case 'article':

		$article = App\Tasks\GetArticleTask::get( $baseUrl, $sparseFieldsets );

		$data  = [
			'data' => $article->toResource(),
			'included' => $article->getIncluded( $include )
		];
		echo '<pre>', json_encode( $data, JSON_PRETTY_PRINT);
		break;
	
	case 'articles':
	

		$articles = App\Tasks\GetAllArticlesTask::get( $baseUrl, $sparseFieldsets );
		$resource = new Bag( $baseUrl );
		$included = new Bag( $baseUrl );
		
		foreach ($articles as $article) {
			$resource->add( $article->toResource() );
			$included->add( $article->getIncluded( $include ) );
		}

		$data = [
			"data" => $resource->getAll(),
			"included" => $included->getAll(),
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