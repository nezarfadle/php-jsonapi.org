<?php

include 'vendor/autoload.php';

use App\Article,
	App\Author,
	App\Comment,
	App\ArticleEntity,
	JsonApi\Bag

;

$op = $_GET['op'];

switch ($op) {
	case 'article':
		$article = App\Tasks\GetArticleTask::get();

		$data  = [
			'data' => $article->toResource(),
			'included' => $article->getIncluded()
		];
		echo '<pre>', json_encode( $data, JSON_PRETTY_PRINT);
		break;
	
	case 'articles':
	

		$articles = App\Tasks\GetAllArticlesTask::get();
		$resource = new Bag();
		$included = new Bag();
		
		foreach ($articles as $article) {
			$resource->add( $article->toResource() );
			$included->add( $article->getIncluded() );
		}

		$data = [
			"data" => $resource->getAll(),
			"included" => $included->getAll(),
		];
		echo '<pre>', json_encode( $data, JSON_PRETTY_PRINT);
		break;
}

class Foo
{
	public $id;
	public function __construct( $id )
	{
		$this->id = $id;
	}
}

$f1 = new Foo(1);
$f2 = new Foo(2);

echo spl_object_hash( $f1 ), '<br>';
echo spl_object_hash( $f2 ), '<br>';