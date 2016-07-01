<?php  namespace App\Tasks;

use App\Article,
	App\Comment,
	App\Author
;


class GetAllArticlesTask
{
	public static function get()
	{
		$data = [];	

		for ($i=1; $i < 4 ; $i++) { 

			$article = new Article( $i, "PHP & Mysql", "PHP is Cool");
			$article->writtenBy( new Author($i, "Nezar Fadle", "email@gmail.com" ));
			$article->has( new Comment( $i, "First Comment", "Just First Comment" ));
			// $article->has( new Comment( $i + 1, "Second Comment", "Just Second Comment" ));
			// $article->has( new Comment( $i + 2, "Second Comment", "Just Second Comment" ));

			$data[] = $article;
			
		}

		return $data;
	}
}