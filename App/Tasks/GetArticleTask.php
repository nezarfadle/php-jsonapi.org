<?php  namespace App\Tasks;

use App\Article,
	App\Comment,
	App\Author,
	App\ArticleTransformer
;

class GetArticleTask
{
	public static function get( $baseUrl, $sparseFieldsets = [] )
	{
		$article = new Article( 1, "PHP & Mysql", "PHP is Cool");
		$article->writtenBy( new Author(1, "Nezar Fadle", "email@gmail.com" ));
		
		$author1 = new Author(10, "Author no 10 ", "email@gmail.com" );
		$author2 = new Author(20, "Author no 20 ", "email@gmail.com" );

		$article->has( new Comment( 1, "First Comment", "Just First Comment", $author1 ));
		$article->has( new Comment( 2, "Second Comment", "Just Second Comment", $author2 ));

		return new ArticleTransformer( $article, $baseUrl, $sparseFieldsets );
	}
}