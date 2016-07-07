<?php  namespace App\Tasks;

use App\Article,
	App\Comment,
	App\Author,
	App\ArticleTransformer
;

class GetAllArticlesTask
{
	public static function get( $baseUrl, $sparseFieldsets = [] )
	{
		$data = [];	
		$author1 = new Author(10, "Author no 10 ", "email@gmail.com" );
		$author2 = new Author(20, "Author no 20 ", "email@gmail.com" );

		for ($i=1; $i < 4 ; $i++) { 

			$article = new Article( $i, "PHP & Mysql", "PHP is Cool");
			// $article->writtenBy( new Author($i, "Nezar Fadle", "email@gmail.com" ));
			$article->writtenBy( new Author( 1, "Nezar Fadle", "email@gmail.com" ));
			$article->has( new Comment( $i, "First Comment", "Just First Comment", $author1 ));
			$article->has( new Comment( $i + 1, "Second Comment", "Just Second Comment", $author2 ));
			$articleResource = new ArticleTransformer( $article, $baseUrl, $sparseFieldsets );

			$data[] = $articleResource;
			
		}

		return $data;
	}
}