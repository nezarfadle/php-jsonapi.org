<?php

include 'vendor/autoload.php';

use App\Article,
	App\Author,
	App\Comment,
	App\ArticleTransformer,
	App\AuthorTransformer,
	App\AuthorProvider,
	App\CommentTransformer,
	App\CommentProvider,
	JsonApi\CompoundResource,
	JsonApi\SingleResource

;




$article = new Article( 1, "PHP & Mysql", "PHP is Cool");
$article->writtenBy( new Author(1, "Nezar Fadle", "email@gmail.com" ));
$article->has( new Comment( 1, "First Comment", "Just First Comment" ));
$article->has( new Comment( 2, "Second Comment", "Just Second Comment" ));

$baseUrl = "http://example.com/api/v1" ;

$articleResource = new CompoundResource([
	'main' => new ArticleTransformer( $article ),
	"features" => [
		"attributes", "links", "meta", "jsonapi",
		'relationships' => [
			'author' => new AuthorProvider( $article->author ),
			// 'comments' => new CommentProvider( $article->comments ),
		],
		'included' => [ 'author' ]
	]
	
]);
echo '<pre>', json_encode( $articleResource->getSchema(), JSON_PRETTY_PRINT);
// echo '<pre>', json_encode( [ 'data' => $articleResource->getSchema() ], JSON_PRETTY_PRINT);
