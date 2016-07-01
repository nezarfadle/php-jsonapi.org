<?php

include 'vendor/autoload.php';

use App\Article,
	App\Author,
	App\Comment,
	App\ArticleEntity

;

$article = new Article( 1, "PHP & Mysql", "PHP is Cool");
$article->writtenBy( new Author(1, "Nezar Fadle", "email@gmail.com" ));
$article->has( new Comment( 1, "First Comment", "Just First Comment" ));
$article->has( new Comment( 2, "Second Comment", "Just Second Comment" ));


// $articleResource = new Resource([
// 	// 'main' => new ArticleTransformer( $article ),
// 	'baseurl' => 'http://example.com/api/v1',
// 	'entity' => new ArticleEntity( $article ),
// 	"features" => [
// 		"attributes", "links", "meta",
// 		'relationships' => [
// 			'author' => new AuthorProvider( $article->author ),
// 			'comments' => new CommentProvider( $article->comments ),
// 		],
// 		'included' => [ 'author', 'comments']
// 	]
	
// ]);

// $data = [
// 	"data" => $articleResource->getData(),
// 	"included" => $articleResource->getIncluded(),
// ];

// $articleResource = new ArticleEntity( $article );

// $data = [
// 	"data" => $articleResource->toResource(),
// 	"included" => $articleResource->getIncluded(),
// ];


/**
 * /articles
 */
$buffer = [];
$include = [];

$articles = App\Tasks\GetAllArticlesTask::get();
foreach ($articles as $article) {
	$articleResource = new ArticleEntity( $article );
	$buffer[] = $articleResource->toResource();
	$include  =  $articleResource->getIncluded();
}

$data = [
	"data" => $buffer,
	"included" => $include,
];
echo '<pre>', json_encode( $data, JSON_PRETTY_PRINT);
// echo '<pre>', json_encode( [ 'data' => $articleResource->getSchema() ], JSON_PRETTY_PRINT);
