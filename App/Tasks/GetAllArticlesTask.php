<?php  namespace App\Tasks;

use App\Article,
	App\Comment,
	App\Author,
	App\ArticleTransformer
;

class GetAllArticlesTask
{
	public static function get( $baseUrl )
	{
		$data = [];	

		for ($i=1; $i < 4 ; $i++) { 

			$article = new Article( $i, "PHP & Mysql", "PHP is Cool");
			// $article->writtenBy( new Author($i, "Nezar Fadle", "email@gmail.com" ));
			$article->writtenBy( new Author( 1, "Nezar Fadle", "email@gmail.com" ));
			$article->has( new Comment( $i, "First Comment", "Just First Comment" ));
			$article->has( new Comment( $i + 1, "Second Comment", "Just Second Comment" ));
			$articleResource = new ArticleTransformer( $article, $baseUrl );

			$data[] = $articleResource;
			
		}

		return $data;
	}
}